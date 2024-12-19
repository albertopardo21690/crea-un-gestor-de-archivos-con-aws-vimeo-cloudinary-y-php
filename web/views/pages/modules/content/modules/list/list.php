<!--=============================================
LIST
===============================================-->

<div class="table-responsive modules" id="list">

    <table class="table mb-5">
        
        <thead>
            
            <th>Preview</th>
            <th>Name</th>
            <th>Size</th>
            <th>Folder</th>
            <th>Link</th>
            <th>Modified</th>
            <th>Actions</th>

        </thead>

        <tbody>

            <?php for( $i = 0; $i < 10; $i++) : ?>

                <tr style="height: 100px;">

                    <td>
                        <img src="https://via.placeholder.com/100x100" class="rounded">
                    </td>

                    <td class="align-middle">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="lorem_ipsum">
                            <span class="input-group-text">.jpg</span>
                        </div>
                    </td>

                    <td class="align-middle">415.2 MB</td>

                    <td class="align-middle">
                        <span class="badge bg-dark rounded px-3 py-2 text-white">AWS S3</span>
                    </td>

                    <td>
                        http://file-manager-system.com/lorem_i...
                        <i class="bi bi-box-arrow-up-right ps-2 btn"></i>
                    </td>

                    <td class="align-middle">2024-07-05, 12:08:00</td>

                    <td class="align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor: pointer;">
                          <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                        </svg>

                        <i class="bi bi-trash ps-2 btn"></i>
                    </td>

                </tr>

            <?php endfor; ?>

        </tbody>

    </table>

</div>