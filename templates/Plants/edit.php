<div class="container-fluid mt-1">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Plant</h4>
                </div>
                <form action="<?= $this->Url->build(['controller' => 'plants', 'action' => 'add']) ?>" method="POST">
                    <div class="card-body">
                        <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
                        <div class="form-group">
                            <label for="plant_code">Plant Code:</label>
                            <input type="text" class="form-control" placeholder="Enter Plant Code" id="plant_code" name="plant_code" value="<?= !empty($plant_data->plant_code) ? $plant_data->plant_code : "" ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="plant_name">Plant Name:</label>
                            <input type="text" class="form-control" placeholder="Enter Plant Name" id="plant_name" name="plant_name" value = "<?= !empty($plant_data->plant_desc) ? $plant_data->plant_desc : "" ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>