@extends('layouts.app')
@section('content')
<style>
 .print_div table tbody td {
    padding: 10px;
    text-align: justify;
    line-height: 25px;
}
.print_div{
    display: none;
}
@media print {
    .print_div{
    display: block;
}
}
</style>
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                         Regular Examination Application (UG) 
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="none-2 text-center mb-4">
                            <h1 class="subheader-title mb-1">
                                UTKAL UNIVERSITY OF CULTURE, BHUBANESWAR
                            </h1>
                            <h4 style="font-weight:500;">( APPLICATION FORM FOR ADMISSION TO EXAMINATION )</h4>
                            
                        </div>
                       
                        
                        <div class="border rounded p-2 mb-4">
                            <h4>Personal Information</h4>
                            <hr>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name : </th>
                                    <td>{{$student_details->name}}</td>
                                    <th>Mobile No :</th>
                                    <td>{{$student_details->mobile}}</td>
                                </tr>
                                <tr>
                                    <th>Father's Name : </th>
                                    <td>{{$student_details->father_name}}</td>
                                    <th>Mother's name :</th>
                                    <td>{{$student_details->mother_name}}</td>
                                </tr>
                                <tr>
                                    
                                    <th colspan="2">Local Address : </th>
                                    <th colspan="2">Permanent Address</th>
                                </tr>
                                <tr>
                                    @php
                                    $permanent_address = trim($student_address->permanent_address .' , '.$student_address->permanentDistrict->district_name.' , '.$student_address->permanent_pin_code.' , '.$student_address->permanent_state);
                                    //dd($permanent_address);
                                    @endphp
                                    <td colspan="2">{{$student_address->present_address}},{{$student_address->presentDistrict->district_name}},{{$student_address->present_pin_code}},{{$student_address->present_state}} </td>
                                    <td colspan="2">{{$permanent_address}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Caste Category  : </th>
                                    <td colspan="2">{{$student_details->cast}}</td>
                                </tr>
                            </table>

                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Marticulation / H.S.C / Equivalent Information</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name of School</th>
                                        <th>Passing year </th>
                                        <th>Passing Month</th>
                                        <th>Division </th>
                                        <th>Roll No</th>
                                        <th>DOB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>{{$edu_hsc->passing_year}}</td>
                                        <td></td>
                                        <td>{{$edu_hsc->division}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>+2 / Intermediate Examination in Arts / Science / Commerce or any Equivalent Examination</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name of College</th>
                                        <th>Passing year </th>
                                        <th>Passing Month</th>
                                        <th>Division </th>
                                        <th>Roll No</th>
                                        <th>DOB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>{{$edu_intermediate->passing_year}}</td>
                                        <td></td>
                                        <td>{{$edu_intermediate->division}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        
                       
                        <div class="border rounded p-2 mb-4">
                            <h4>BSE Exam Details</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Year </th>
                                        <th>Name of Examination </th>
                                        <th>Roll No</th>
                                        <th>Regd. No. </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bse_exams as $item)
                                        
                                    
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->year}}</td>
                                        <td>{{$item->name_of_exam}}</td>
                                        <td>{{$item->roll_no}}</td>
                                        <td>{{$item->regd_no}}</td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Course </th>
                                        <th>Theory/Practical </th>
                                        <th>Description</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bse_examines as $item)
                                    <tr>
                                        <td>{{$item->course}}</td>
                                        <td>{{$item->theory_practical}}</td>
                                        <td>{{$item->description}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            

                        </div>
                        <hr>

                        <div class="print_div">
                            <h3 class="text-center mb-4">CERTIFICATIE</h3>
                            <table class="mb-2">
                                <tr valign=top>
                                    <td>A. </td>
                                    <td>Certified (1) that the particulars given overleaf by the candidate are correct, (2) that I have
                                        verified his/ her certificates of the qualifying examination and the registration receipt in original,
                                        (3) that his/ her conduct has been good, (4) that he/she has studied diligently and (5) that
                                        he/she has satisfactorily passed the college periodical eaminations and other tests and there
                                        is all probability of his/her passing the examination. Nothing is known to me against his/her
                                        moral character. (6) that the candidate has secured the percentage of attendance. (7) that the
                                        fees prescribed by the University have been paid by the candidate and deposited.</td>
                                </tr>
                            </table>

                            <table >
                                <tr valign=top>
                                    <td>B. </td>
                                    <td><p>(In case of Compartmental appearance) Certified that Sri/ Smt.
                                        --------------------- with Roll No.
                                        appeared in Examination in ---------------------------  with Roll No. ----------------------
                                        is eligible to appear in the subjects  ---------------------- Compartmental/ Back
                                        paper.</p></td>
                                </tr>
                            </table>

                            <table>
                                <tr valign=top>
                                    <td>C. </td>
                                    <td>(In case of candidates who had already appeared) Certified that the results of the candidate
                                        has not been withheld or he/she has not been debarred from appearing at the present
                                        examination for being reported to have infringed the rules of examination discipline.</td>
                                </tr>
                            </table>
                        </div>

                        <form action="{{route('regular_exam_final',[$id])}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light">Submit</button>
                                {{-- <a href="{{route('regular_exam_preview',[$id])}}"   class="btn btn-success me-1 waves-effect waves-float waves-light">Preview</a> --}}
                                <button type="button" class="btn btn-primary waves-effect waves-light print_btn" onclick="window.print()">Print this page</button>
                            </div>
                        
                        
                            
                        </div>
                    </form>

                      
                        

                        
                        

                        
                       


                    </div>
                </div>
            </div>


        </div>
    </div>


    
@endsection

@section('js')

@endsection
