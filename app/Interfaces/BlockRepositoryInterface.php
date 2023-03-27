<?php

namespace App\Interfaces;

interface BlockRepositoryInterface
{
    public function getAllBlocks();
    public function getBlockById($blockId);
    public function deleteBlock($blockId);
    public function createBlock($blockDetails);
    public function updateBlock($blockId, array $newDetails);
    public function enableRecord($blockId);
    public function disableRecord($blockId);
}