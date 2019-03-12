<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ReportsJob;

class ReportController extends Controller
{
    /**
     * @var PostRepository
     */
    public $repo;

    public $titles = [
        'views' => 'Очет по просмотрам',
        'comments' => 'Очет по комментам',
    ];

    public function __construct(PostRepository $postRepository)
    {
        $this->repo = $postRepository;
    }

    public function index($action = 'views')
    {
        $title = $this->titles[$action];
        $files = $this->repo->getReportsFilesListSort($action);
        return \View::make('admin.reports.index', compact(['title', 'action', 'files']));
    }

    public function generateReport($action, Request $request)
    {
        $request->flash();
        $data = $request->only(['date_to', 'date_from']);
        if ($request->has('download')) {
            dispatch(new ReportsJob($action, $data));
            \Alert::success('Report genereted')
                ->flash();
        }

        return redirect()->route('admin.report', ['action' => $action]);
    }

    public function downloadReport($action, $file)
    {
        $exists = $this->repo->reportExist($action, $file);
        if ($exists) {
            return response()->download(storage_path('exports/' . $action . '/' . $file));
        }
        return redirect()->back();
    }

    public function deleteReport($action, $file)
    {
        $exists = $this->repo->reportExist($action, $file);
        if ($exists) {
            Storage::disk('reports')->delete($action . '/' . $file);
            \Alert::success('File removed')->flash();
        }
        return redirect()->back();
    }
}
