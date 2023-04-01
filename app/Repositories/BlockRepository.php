<?php

namespace App\Repositories;

use App\Interfaces\BlockRepositoryInterface;
use App\Models\Block;

class BlockRepository implements BlockRepositoryInterface
{
    /**
     * It returns all the societies that are active and ordered by the latest.
     * 
     * @return A collection of all the active societies in the database.
     */
    public function getAllBlocks()
    {
        return Block::active()->latest()->get();
    }

    /**
     * It returns a block object from the database, or throws an exception if it doesn't exist.
     * 
     * @param blockId The id of the block you want to get.
     * 
     * @return A single block object.
     */
    public function getBlockById($blockId)
    {
        return Block::findOrFail($blockId);
    }

    /**
     * It deletes a block from the database
     * 
     * @param blockId The id of the block to be deleted.
     */
    public function deleteBlock($blockId)
    {
        Block::destroy($blockId);
    }

    /**
     * It creates a new block.
     * 
     * @param blockDetails 
     * 
     * @return The return value is the newly created block.
     */
    public function createBlock($blockDetails)
    {
        return Block::create($blockDetails);
    }

    /**
     * It updates the block with the given id with the given new details
     * 
     * @param blockId The id of the block to be updated
     * @param newDetails 
     * 
     * @return The query builder instance.
     */
    public function updateBlock($blockId, $newDetails)
    {
        return Block::whereId($blockId)->update($newDetails);
    }

    /**
     * It enables a block record
     * 
     * @param blockId The id of the block you want to enable.
     * 
     * @return The block object.
     */
    public function enableRecord($blockId)
    {
        $block = $this->getBlockById($blockId);
        $block->status = "1";
        $block->save();
        return $block;
    }
    
    /**
     * It disables a block record
     * 
     * @param blockId The id of the block you want to disable.
     * 
     * @return The block object.
     */
    public function disableRecord($blockId)
    {
        $block = $this->getBlockById($blockId);
        $block->status = "0";
        $block->save();
        return $block;
    }
}
