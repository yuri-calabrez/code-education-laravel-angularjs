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

    public function __construct(ProjectFileRepositoryInterface $repository, ProjectFileService $service)
    {

        $this->service = $service;
        $this->repository = $repository;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request, $id)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function showFile($id, $fileId)
    {
        $filePath = $this->service->getFilePath($fileId);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);
        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($fileId)
        ];
    }

    public function show($id, $fileId)
    {
        return $this->repository->find($fileId);
    }

    public function update(Request $request, $id, $fileId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $fileId);
    }

    public function destroy($id, $fileId)
    {
        return $this->service->delete($fileId);
    }
}
