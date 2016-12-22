<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepositoryInterface;
use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileService
     */
    private $service;
    /**
     * @var ProjectFileRepositoryInterface
     */
    private $repository;

    public function __construct(ProjectFileRepositoryInterface $repository ,ProjectFileService $service)
    {

        $this->service = $service;
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $request->project_id;
        return $this->service->create($data);
    }

    public function destroy($id, $fileId)
    {
        return $this->service->delete($fileId);
    }
}
