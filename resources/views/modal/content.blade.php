<div class="modal fade content-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add content</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group mb-2">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" id="description"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="">Thumbnail</label>
                    <input type="file" class="form-control" id="logo">
                </div>
                <div class="form-group mb-2">
                    <label for="">Category</label> 
                    <select name="" id="" class="form-select list-category-content">
                        <option value="">Study</option>
                         
                    </select>
                </div>
                 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="accept-content" data-id="" class="btn btn-primary accept-save-content">Save</button>
            </div>
        </div>
    </div>
</div>