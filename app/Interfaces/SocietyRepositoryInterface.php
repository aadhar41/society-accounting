<?php

namespace App\Interfaces;

interface SocietyRepositoryInterface
{
    public function getAllSocieties();
    public function getSocietyById($societyId);
    public function deleteSociety($societyId);
    public function createSociety($societyDetails);
    public function updateSociety($societyId, array $newDetails);
    public function enableRecord($societyId);
    public function disableRecord($societyId);
}