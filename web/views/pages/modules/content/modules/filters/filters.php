<!--=====================================
FILTERS
======================================-->

<div class="col-12 col-lg-5 mt-3">
  
    <div class="d-flex flex-row-reverse">

        <div class="btn-group rounded">
            <button type="button" class="btn btn-default border rounded-start text-secondary changeView" module="grid">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
            <button type="button" class="btn btn-default border rounded-end bg-dark changeView text-white" module="list">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <select class="form-select rounded mx-2" id="sortBy">
        <option value="">Sort by</option>
        <option value="date_updated_file-DESC">Newest first</option>
        <option value="date_updated_file-ASC">Oldest first</option>
        <option value="size_file-DESC">Largest first</option>
        <option value="size_file-ASC">Smallest first</option>
        <option value="name_file-ASC">A-Z</option>
        <option value="name_file-DESC">Z-A</option>
    </select>

    <select class="form-select rounded" id="filterBy">
        <option value="">Filter by</option>
        <option value="ALL">ALL</option>
        <option value="images/JPG">images/JPG</option>
        <option value="video/mp4">video/mp4</option>
        <option value="application/pdf">application/pdf</option>
        <option value="application/zip">application/zip</option>
    </select>
        
    </div>

</div>