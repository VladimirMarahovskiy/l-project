<?php


namespace App\Repositories;

use App\Models\Post;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\StyleBuilder;


class PostRepository
{
    public $report = [
        'views' => [
            'title' => 'Report Views',
            'headers' => [

                'created', 'Post Id', 'Url', 'Views'


            ],
        ],
        'comments' => [
            'title' => 'Report comments',
            'headers' => [
                [
                    'created', 'Post Id', 'Url', 'Comments'
                ],

            ],
        ],
    ];
    public $from;
    public $to;

    public static function generatePost($count)
    {
        //
        $faker = Factory::create();
        for ($i = 0; $i <= $count; $i++) {
            $post = new Post([
                'author_id' => 1,
                'title' => $faker->sentence . $i,
                'category_id' => 1,
                'views' => 0,
                'comments' => 0,
                //'content' => file_get_contents('https://baconipsum.com/api/?type=all-meat&paras=2&start-with-lorem=1'),
                'content' => $faker->paragraph,
                'posted_at' => Carbon::now(),
                'slug' => $faker->sentence . $i,
                'image' => self::getImage(),
            ]);
            $post->save();
        }
    }

    public static function getImage()
    {
        $url = 'https://picsum.photos/g/200/300';
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $info['basename']);
        return $uploaded_file;
    }

    public function updatePostData($data)
    {
        $post = Post::find($data['id']);

        $post->views = $data['views'];
        $post->comments = $data['comments'];

        $post->save();
    }

    public function setData($data)
    {
        $this->from = Carbon::createFromFormat('Y-m-d', $data['date_from'])->startOfDay();
        $this->to = Carbon::createFromFormat('Y-m-d', $data['date_to'])->endOfDay();
    }

    public function makeReport($action)
    {
        $notWrappedStyle = (new StyleBuilder())
            ->setShouldWrapText(false)
            ->build();
        $fileName = $this->generateReportFileName($action);
        $path = storage_path('exports/' . $action . '/');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $writer = WriterFactory::create(Type::XLSX);
        $writer->setDefaultRowStyle($notWrappedStyle)
            ->setTempFolder(storage_path('exports'))
            ->openToFile($path . $fileName);
        $this->getReportData($writer, $this->report[$action]['headers']);
        $writer->close();
    }

    private function getReportData($writer, $header)
    {

        $boldStyle = (new StyleBuilder())
            ->setFontBold()
            ->build();

        $sheet = $writer->getCurrentSheet();
        $sheet->setName('Data');
        $writer->addRowWithStyle($header, $boldStyle);

        Post::whereBetween('created_at', [$this->from, $this->to])
            ->select(['created_at', 'title', 'comments', 'views'])
            ->chunk(500, function ($records) use (&$writer) {
                foreach ($records as $record) {

                    $row = [];
                    $row[] = $record->created_at->toDateTimeString();
                    $row[] = $record->title;
                    $row[] = $record->comments;
                    $row[] = $record->views;

                    $writer->addRow($row);
                }
            });
    }


    private function generateReportFileName($action)
    {
        $testFileName = $this->report[$action]['title'];
        if ($action === 'rates' && $this->rate->isNotEmpty()) {
            $testFileName .= '_' . $this->rate->implode('_');
        }
        if ($action === 'rates' && $this->comments) {
            $testFileName .= '_comments';
        }
        $testFileName .= '_' . $this->from->format('d_m_Y') . '_' . $this->to->format('d_m_Y');
        $sameReports = $this->getReportsFilesList($action)->filter(function ($i) use ($testFileName) {
            return strpos($i, $testFileName) !== false;
        });
        if ($sameReports->isNotEmpty()) {
            $num = $sameReports->map(function ($i) use ($testFileName) {
                return (int)(str_replace([$testFileName . '_', '.xls'], '', $i));
            })->max();
            $testFileName .= '_' . ($num + 1);
        }
        return $testFileName . '.xlsx';
    }

    public function getReportsFilesList($action)
    {
        return collect(Storage::disk('local')->files($action))->map(function ($i) use ($action) {
            return str_replace($action . '/', '', $i);
        });
    }


    public function getReportsFilesListSort($action)
    {
        $collection = collect(Storage::disk('local')->files($action))
            ->reject(function ($i) {
                return Storage::disk('local')->size($i) == 0;
            })
            ->map(function ($i) use ($action) {
                $file['name'] = str_replace($action . '/', '', $i);
                $file['date'] = Storage::disk('local')->lastModified($i);
                return $file;
            });

        $sorted = $collection->sortByDesc(function ($item) {
            return $item['date'];
        });
        $sorted->values()->all();

        return $sorted;
    }

}
