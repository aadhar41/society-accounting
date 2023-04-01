<?php

namespace App\Repositories;

use App\Interfaces\SocietyRepositoryInterface;
use App\Models\Society;

class SocietyRepository implements SocietyRepositoryInterface
{
    /**
     * It returns all the societies that are active and ordered by the latest.
     * 
     * @return A collection of all the active societies in the database.
     */
    public function getAllSocieties()
    {
        return Society::active()->latest()->get();
    }

    /**
     * It returns a society object from the database, or throws an exception if it doesn't exist.
     * 
     * @param societyId The id of the society you want to get.
     * 
     * @return A single society object.
     */
    public function getSocietyById($societyId)
    {
        return Society::findOrFail($societyId);
    }

    /**
     * It deletes a society from the database
     * 
     * @param societyId The id of the society to be deleted.
     */
    public function deleteSociety($societyId)
    {
        Society::destroy($societyId);
    }

    /**
     * It creates a new society.
     * 
     * @param societyDetails 
     * 
     * @return The return value is the newly created society.
     */
    public function createSociety($societyDetails)
    {
        return Society::create($societyDetails);
    }

    /**
     * It updates the society with the given id with the given new details
     * 
     * @param societyId The id of the society to be updated
     * @param newDetails 
     * 
     * @return The query builder instance.
     */
    public function updateSociety($societyId, $newDetails)
    {
        return Society::whereId($societyId)->update($newDetails);
    }

    /**
     * It enables a society record
     * 
     * @param societyId The id of the society you want to enable.
     * 
     * @return The society object.
     */
    public function enableRecord($societyId)
    {
        $society = $this->getSocietyById($societyId);
        $society->status = "1";
        $society->save();
        return $society;
    }
    
    /**
     * It disables a society record
     * 
     * @param societyId The id of the society you want to disable.
     * 
     * @return The society object.
     */
    public function disableRecord($societyId)
    {
        $society = $this->getSocietyById($societyId);
        $society->status = "0";
        $society->save();
        return $society;
    }
}
