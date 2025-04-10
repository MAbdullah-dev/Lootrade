<div style="flex: 1">
    <section class="admin-raffles">
        <div class="inner">
            <div class="head">
                <div class="search-feild">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>

                <div class="button-wrapper">
                    <div class="select-feild">
                        <select class="form-select" aria-label="Default select example">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create Raffle
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="model-inner">
                                    <div class="input-wrapper mb-3">
                                        <label for="" class="form-label">Tittle</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="input-wrapper mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>

                                    <div class="input-wrapper mb-3">
                                        <label for="" class="form-label">minimum tickets</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="input-wrapper mb-3">
                                        <label for="" class="form-label">Price</label>
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                    <div class="input-wrapper mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input class="form-control flatpickr-input" id="s-date"
                                            placeholder="Select date" />
                                    </div>
                                    <div class="input-wrapper mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input class="form-control flatpickr-input" id="e-date"
                                            placeholder="Select date" />
                                    </div>

                                    <div class="input-wrapper mb-3 w-100">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown button
                                            </button>
                                            <ul class="dropdown-menu bg-gray">
                                                <li><a class="dropdown-item text-black" href="#">Action</a></li>
                                                <li><a class="dropdown-item text-black" href="#">Another
                                                        action</a></li>
                                                <li><a class="dropdown-item text-black" href="#">Something else
                                                        here</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="input-wrapper mb-3 w-100">
                                        <label for="" class="form-label">Upload Picture</label>
                                        <input type="file" name="" id="" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-custom">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="body table-responsive rounded shadow">
                <table class="table table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>@social</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@push('js')
    <script>
        $("#s-date").flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: null,
            minDate: "1900-01-01",
            enableTime: false,
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            clickOpens: true,
            disableMobile: false
        });

        $("#e-date").flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: null,
            minDate: "1900-01-01",
            enableTime: false,
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            clickOpens: true,
            disableMobile: false
        });
    </script>
@endpush
