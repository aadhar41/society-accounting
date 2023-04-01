<?php

namespace App\Repositories;

use App\Interfaces\PlotRepositoryInterface;
use App\Models\Plot;

class PlotRepository implements PlotRepositoryInterface
{

    /**
     * It returns all the plots that are active and ordered by the latest.
     * 
     * @return A collection of all the active plots in the database.
     */
    public function getAllPlots()
    {
        return Plot::active()->latest()->get();
    }


    /**
     * It returns a plot object from the database, or throws an exception if it doesn't exist
     * 
     * @param id The id of the plot you want to get.
     * 
     * @return A single plot object.
     */
    public function getPlotById($id)
    {
        return Plot::findOrFail($id);
    }


    /**
     * It deletes a plot from the database
     * 
     * @param id The id of the plot you want to delete
     */
    public function deletePlot($id)
    {
        Plot::destroy($id);
    }


    /**
     * It creates a new plot in the database
     * 
     * @param data array
     * 
     * @return A new instance of the Plot model.
     */
    public function createPlot($data)
    {
        return Plot::create($data);
    }


    /**
     * It updates the plot with the id of  with the data of 
     * 
     * @param id The id of the plot you want to update
     * @param data 
     * 
     * @return The return value is the number of rows affected by the update.
     */
    public function updatePlot($id, $data)
    {
        return Plot::whereId($id)->update($data);
    }
    

    /**
     * It gets a record by id, sets the status to 1, and then saves it.
     * 
     * @param id The id of the record you want to enable
     * 
     * @return The data is being returned.
     */
    public function enableRecord($id)
    {
        $data = $this->getPlotById($id);
        $data->status = "1";
        $data->save();
        return $data;
    }


    /**
     * It gets a record by id, sets the status to 0, and saves it
     * 
     * @param id The id of the record you want to disable
     * 
     * @return The data is being returned.
     */
    public function disableRecord($id)
    {
        $data = $this->getPlotById($id);
        $data->status = "0";
        $data->save();
        return $data;
    }
}
