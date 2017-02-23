<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepositoryInterface;
use CodeProject\Repositories\ProjectRepositoryInterface;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileService
{
    /**
     * @var ProjectFileRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;
    /**
     * @var ProjectFileValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    public function __construct(ProjectFileRepositoryInterface $repository,
                                ProjectRepositoryInterface $projectRepository,
                                ProjectFileValidator $validator,
                                Filesystem $filesystem, Storage $storage)
    {

        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
            return ['error' => false, 'message' => 'Arquivo salvo com sucesso!'];
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        }
    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data, $id);
        }catch (ValidatorException $e){
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        }
    }

    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseUrl($projectFile);
    }

    private function getBaseUrl($projectFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                .'/'.$projectFile->getFileName();
                break;
        }
    }

    public function getFileName($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $projectFile->getFileName();
    }

    public function delete($fileId)
    {
        try {
            $file = $this->repository->skipPresenter()->find($fileId);
            $fileName = $file->getFileName();
            if ($this->storage->exists($fileName)) {
                $this->storage->delete($fileName);
                $this->repository->delete($fileId);
            }
            return ['error' => false, 'message' => 'Arquivo removido com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Arquivo não encontrado'];
        }
    }
}