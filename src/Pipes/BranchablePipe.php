<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Transport;

abstract class BranchablePipe extends SimplePipe
{
    public function handle(Transport $transport): void
    {
        $branch = $this->branch($transport);

        if (! $branch) {
            return;
        }

        $transport->getPipeline()->patchBranch(...$branch->getPipes());
    }

    abstract public function branch(Transport $transport): ?PipeCollection;
}
