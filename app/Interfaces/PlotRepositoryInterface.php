<?php

namespace App\Interfaces;

interface PlotRepositoryInterface
{
    public function getAllPlots();
    public function getPlotById($plotId);
    public function deletePlot($plotId);
    public function createPlot($plotDetails);
    public function updatePlot($plotId, array $newDetails);
    public function enableRecord($plotId);
    public function disableRecord($plotId);
}