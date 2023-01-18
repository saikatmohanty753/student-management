@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="formData" enctype="multipart/form-data" action="" class="mt-2">
                        <input type="hidden" name="_token" value="">
                        <div class="border rounded p-2 mb-2">
                            <h2>Personal Information</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-status">Course</label>
                                        <select class="form-select form-control" id="blog-edit-status" name="course">
                                            <option value="">Select College</option>
                                            <option value="1">UG001 - Bachelor of Performing Art in Odissi Dance
                                            </option>
                                            <option value="2">UG002 - uu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Mobile Number</label>
                                        <input name="mob_no" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Father Name</label>
                                        <input name="father_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-status">Gender</label>
                                        <select class="form-select form-control" id="blog-edit-status" name="gender">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                            <option value="2">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">DOB</label>
                                        <input name="dob" type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="cast_category">Caste Category</label>
                                        <select class="form-select form-control" id="cast_category" name="cast_category">
                                            <option value="ST">ST</option>
                                            <option value="SC">SC</option>
                                            <option value="OBC">OBC</option>
                                            <option value="GEN">GEN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-status">If Specially Abled</label>
                                        <select class="form-select form-control" id="specially_abled"
                                            name="specially_abled">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Aadhar No</label>
                                        <input name="aadhar_no" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Mobile</label>
                                        <input name="mobile" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="border rounded p-2 mb-2">
                            <h2>Address Information</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                <label class="form-label" for="blog-edit-status">State</label>
                                                <select class="form-select form-control" id="blog-edit-status"
                                                    name="present_state">
                                                    <option value="1">Andaman &amp; Nicobar Islands</option>
                                                    <option value="2">Andhra Pradesh</option>
                                                    <option value="3">Arunachal Pradesh</option>
                                                    <option value="4">Assam</option>
                                                    <option value="5">Bihar</option>
                                                    <option value="6">Chandigarh</option>
                                                    <option value="7">Chhattisgarh</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                <label class="form-label" for="blog-edit-status">District</label>
                                                <select class="form-select form-control" id="blog-edit-status"
                                                    name="present_district">
                                                    <option value="1">Angul</option>
                                                    <option value="2">Balangir</option>
                                                    <option value="3">Baleswar</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label class="form-label">Pincode</label>
                                            <input class="form-control" name="present_pin_code">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Present Address</label>
                                        <textarea class="form-control" name="present_address"></textarea>
                                    </div>

                                </div>

                                <div class="col-md-6 col-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                <label class="form-label" for="blog-edit-status">State</label>
                                                <select class="form-select form-control" id="blog-edit-status"
                                                    name="permanent_state">
                                                    <option value="1">Andaman &amp; Nicobar Islands</option>
                                                    <option value="2">Andhra Pradesh</option>
                                                    <option value="3">Arunachal Pradesh</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                <label class="form-label" for="blog-edit-status">District</label>
                                                <select class="form-select form-control" id="blog-edit-status"
                                                    name="permanent_district">
                                                    <option value="1">Angul</option>
                                                    <option value="2">Balangir</option>
                                                    <option value="3">Baleswar</option>
                                                    <option value="4">Bargarh</option>
                                                    <option value="5">Bhadrak</option>
                                                    <option value="6">Boudh</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label class="form-label">Pincode</label>
                                            <input class="form-control" name="permanent_pin_code">
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Permanent Address
                                            <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><input type="checkbox" id="sameAddress"> Same as present</small>-->
                                        </label>
                                        <textarea class="form-control" name="permanent_address"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="border rounded p-2 mb-2">
                            <h2>College Information</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Last Attended College Name</label>
                                        <input name="last_collage_name" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Year of Passing Last Exam</label>
                                        <input name="last_passing_year" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Last Pursued Course Name</label>
                                        <input name="last_course_name" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="is_migration">Migration Certificate is
                                            availiable</label>
                                        <select class="form-select" id="is_migration" name="is_migration">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border rounded p-2 mb-2">
                            <h2>Document</h2>
                            <hr>
                            <div class="row">
                              <div class="col-md-4 col-12">
                                <div class="featured-info">
                                  <label class="form-label">Photo</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="profile" id="blogCustomFile" accept="image/*">
                                  </div>
                                </div>
                              </div>
            
                              <div class="col-md-4 col-12">
                                <div class="featured-info">
                                  <label class="form-label">Aadhar</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="aadhar_image" id="blogCustomFile" accept="image/*">
                                  </div>
                                </div>
                              </div>
            
                              <div class="col-md-4 col-12">
                                <div class="featured-info">
                                  <label class="form-label">HSC Certificate</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="hsc_certificate">
                                  </div>
                                </div>
                              </div>
{{--             
                              <div class="col-md-4 col-12" id="cast_category_div">
                                <div class="featured-info">
                                  <label class="form-label">Caste Certificate</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="cast_certificate">
                                  </div>
                                </div>
                              </div>
            
                              <div class="col-md-4 col-12" id="specially_abled_div" style="display: none;">
                                <div class="featured-info">
                                  <label class="form-label">Specially Abled</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="specially_abled_document">
                                  </div>
                                </div>
                              </div>
            
                              
            
                              <div class="col-md-4 col-12" id="is_migration_div" style="display: none;">
                                <div class="featured-info">
                                  <label class="form-label">Migration Certificate</label>
                                  <div class="d-inline-block">
                                    <input class="form-control" type="file" name="migration_certificate">
                                  </div>
                                </div>
                              </div> --}}
                            </div>
                          </div>

                        <div class="border rounded p-2 mb-2">
                            <h2>Status</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-status">Student Status</label>
                                        <select class="form-select form-control" id="blog-edit-status" name="status">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-status">Admission Status</label>
                                        <select class="form-select form-control" id="blog-edit-status"
                                            name="admission_status">
                                            <option value="0">Draft</option>
                                            <option value="1">Submit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 text-center mt-50">
                            <button type="submit"
                                class="btn btn-danger me-1 waves-effect waves-float waves-light">Save</button>
                            <button type="" class="btn btn-warning waves-effect">Preview</button>
                            <button type="" class="btn btn-success waves-effect">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
