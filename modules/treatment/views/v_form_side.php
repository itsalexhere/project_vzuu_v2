<input type="hidden" name="id" value="<?= $detail->id ?? '' ?>">

<div class="row">
        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Name</label>
                        <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Name"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Skin Type</label>
                        <input
                                type="text"
                                id="skin_type"
                                name="skin_type"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Skin Type"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Gender</label>
                        <input
                                type="text"
                                id="gender"
                                name="gender"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Gender"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Allergies</label>
                        <input
                                type="text"
                                id="allergies"
                                name="allergies"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Allergies"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Category</label>
                        <input
                                type="text"
                                id="category"
                                name="category"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Category"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Blood_type</label>
                        <input
                                type="text"
                                id="blood_type"
                                name="blood_type"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Blood_type"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Date_of_birth</label>
                        <input
                                type="date"
                                id="date_of_birth"
                                name="date_of_birth"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Date Of Birth"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Emergency_contact</label>
                        <input
                                type="text"
                                id="emergency_contact"
                                name="emergency_contact"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Emergency Contact"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Phone</label>
                        <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Phone"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Favorite_treatments</label>
                        <input
                                type="text"
                                id="favorite_treatments"
                                name="favorite_treatments"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Favorite Treatments"
                                value=""
                                autocomplete="off" />
                </div>
        </div>

        <div class="col-md-12">
                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Email</label>
                        <input
                                type="text"
                                name="email"
                                class="form-control"
                                placeholder="Email"
                                autocomplete="off">
                </div>

                <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6">Address</label>
                        <input
                                type="text"
                                name="address"
                                class="form-control"
                                placeholder="Address"
                                autocomplete="off">
                </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-12">
                <div class="fv-row h-100">
                        <label class="required fw-semibold fs-6">Note</label>
                        <textarea
                                name="note"
                                class="form-control"
                                placeholder="Note"
                                style="resize: none;height: 110px;"
                                autocomplete="off"></textarea>
                </div>
        </div>

</div>