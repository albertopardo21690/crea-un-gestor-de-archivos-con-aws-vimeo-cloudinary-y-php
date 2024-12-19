<!--=============================================
CONTENT
===============================================-->

<div class="container-fluid p-4 min-vh-100" id="content">

    <div class="container bg-white border rounded">

        <!--=============================================
        SEARCH & BUTTONS
        ===============================================-->

        <div class="row py-4 px-4 pb-1 mb-3">

            <?php

                include "modules/search/search.php";
                include "modules/buttons/buttons.php";

            ?>

        </div>

        <!--=============================================
        FOLDERS & FILTERS
        ===============================================-->

        <div class="row pb-4 px-4 py-1">

            <?php

                include "modules/folders/folders.php";
                include "modules/filters/filters.php";

            ?>

        </div>

        <?php

            include "modules/drag_drop/drag_drop.php";
            include "modules/list/list.php";
            include "modules/grid/grid.php";

        ?>

    </div>

</div>