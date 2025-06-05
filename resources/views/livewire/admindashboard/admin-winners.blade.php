<section class="admin-winners" aria-label="Admin Winners Section">
    <div class="container">
        <div class="inner">
            <h2 class="visually-hidden">List of Contest Winners</h2>

            <!-- Filter Inputs -->
            <div class="row filter-section mb-4" role="search" aria-label="Filter Winners">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="searchInput" class="visually-hidden">Search Winners</label>
                    <input type="text" id="searchInput" placeholder="Search" class="form-control search-bar" aria-label="Search Winners by Name or Title">
                </div>
                <div class="col-md-6">
                    <label for="dateInput" class="visually-hidden">Filter by Date Range</label>
                    <input type="text" id="dateInput" placeholder="Date Range" class="form-control date-range" aria-label="Filter by Date Range">
                </div>
            </div>

            <!-- Winners Table -->
            <div class="table-responsive" role="region" aria-label="Winners Table">
                <table class="table table-neon table-hover" aria-describedby="winnersTableCaption">
                    <caption id="winnersTableCaption" class="visually-hidden">This table lists all contest winners with their prize details.</caption>
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Prize</th>
                            <th scope="col">Winner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Art Contest 2025</td>
                            <td>$500</td>
                            <td>Jane Doe</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Coding Challenge</td>
                            <td>$1000</td>
                            <td>John Smith</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Photography Award</td>
                            <td>$750</td>
                            <td>Emily Johnson</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
