@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                         Regular Examination Student List (UG) 
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        
                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline dt-table">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>College Name</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student_details2 as $key => $item)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>{{$item->name}} </td>
                                    <td>{{$item->collegeName()}}</td>
                                    <td>{{$item->department->course_for}}</td>
                                    <td>{{$item->course->name}}</td>
                                    <td>{{$item->semister_name[0]}} semester</td>
                                    <td><a class="btn btn-sm btn-success waves-effect waves-themed" href="{{route('apply_pg_exam',[$item->student_id,$item->semister_name[0]])}}"> Apply </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>
    </div>


    
@endsection

@section('js')
<script>
    $(document).ready(function(){
        
        // add Examined Section
        var countOtherDocRow = 1;
        var counterOtherDocRow = 0;
        
            $('#button_examine').click(function(e) {
                alert('hi');
                e.preventDefault();
                var bde_course = $('#bde_course').val();
                var bde_theo_prac = $('#bde_theo_prac').val();
                var bde_description = $('#bde_description').val();

                
                    var newRow = '<tr>' +
                        '<td>' + bde_course +
                        '<input type="hidden" name="bde_course_hid[]" value="' +
                        bde_course + '"></td>' +

                        '<td>' + bde_theo_prac +
                        '<input type="hidden" name="bde_theo_prac_hid[]" value="' +
                        bde_theo_prac + '"></td>' +

                        '<td>' + bde_description +
                        '<input type="hidden" name="bde_description_hid[]" value="' +
                        bde_description + '"></td>' +

                        
                        '<td><button type="button" class="btn btn-outline-warning waves-effect waves-themed btn-sm remove_field" id="' +
                        counterOtherDocRow + '">Remove</button></td></tr>';
                    $('#addExamined').append(newRow);
                    countOtherDocRow++;
                    counterOtherDocRow++;
                
            });

            $("#addExamined").on("click", ".remove_field", function(e) {
                // alert('1');
                $(this).parent('td').parent('tr').remove();
                counterOtherDocRow--;
                countOtherDocRow--;
            });


            // End Examined Section


            var countBDE = 1;
            var counterBDERow = 0;
        
            $('#button_BDE').click(function(e) {
                alert('hi');
                e.preventDefault();
                var bde_year = $('#bde_year').val();
                var bde_exam = $('#bde_exam').val();
                var bde_roll_no = $('#bde_roll_no').val();
                var bde_regd_no = $('#bde_regd_no').val();

                
                    var newRow = '<tr>' +
                        '<td>' + bde_year +
                        '<input type="hidden" name="bde_year_hid[]" value="' +
                        bde_year + '"></td>' +

                        '<td>' + bde_exam +
                        '<input type="hidden" name="bde_exam_hid[]" value="' +
                        bde_exam + '"></td>' +

                        '<td>' + bde_roll_no +
                        '<input type="hidden" name="bde_roll_no_hid[]" value="' +
                        bde_roll_no + '"></td>' +

                        '<td>' + bde_regd_no +
                        '<input type="hidden" name="bde_regd_no_hid[]" value="' +
                        bde_regd_no + '"></td>' +

                        
                        '<td><button type="button" class="btn btn-outline-warning waves-effect waves-themed btn-sm remove_field" id="' +
                            counterBDERow + '">Remove</button></td></tr>';
                    $('#addBDE').append(newRow);
                    countBDE++;
                    counterBDERow++;
                
            });

            $("#addBDE").on("click", ".remove_field", function(e) {
                // alert('1');
                $(this).parent('td').parent('tr').remove();
                countBDE--;
                counterBDERow--;
            });




        
    });
</script>

<script>
    // dataTable
    // $(document).ready(function(){

    // });
</script>
@endsection
