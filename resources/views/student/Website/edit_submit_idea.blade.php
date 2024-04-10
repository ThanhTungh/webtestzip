@extends('student.Website.layout.app')

@section('title', 'Create Idea Post')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Faculity</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Faculity</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            </div>
        </div>
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <a href="#!">
                        <button class="btn btn-primary">Back to Faculity</button></a>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form>

                                <b>
                                    <p style="font-size: 150%">Faculity :
                                        {{ $single_faculty->name }}</p>
                                </b>

                                <div class="form-group">
                                    <label>Description</label>
                                    <p>{{ $single_faculty->description }}</p>
                                    <li><b>Deadline <i class="feather mr-2 icon-calendar"></i></b>: {{
                                        $single_faculty->date_start }} - {{ $single_faculty->date_end }}</li>
                                    <li><b>Coordinator assigned <i class="feather mr-2 icon-user"></i></b>:
                                        @if ($single_faculty->coordinator_id != 0)
                                        {{ $single_faculty->coordinator->name }}
                                        @else
                                        No Coordinator
                                        @endif
                                    </li>
                                </div>

                            </form>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="table-active">Submission status</td>
                                            <th class="table-success">Submitted for grading</th>
                                        </tr>
                                        <tr>
                                            <td class="table-active">Time Remaining</td>
                                            <th class="table-danger">Assignment was submitted 1 day 4 hours late</th>
                                        </tr>
                                        <tr>
                                            <td class="table-active">File submissions</td>
                                            <th><a href="{{ route('student_download_file', Auth::guard('student')->user()->idea->file) }}"><i
                                                        class="feather mr-2 icon-file"></i>{{ Auth::guard('student')->user()->idea->file }}</a>
                                                <br>
                                                <img src="https://media.istockphoto.com/id/1410046653/vector/cute-school-kids-around-chalkboard-happy-children-with-empty-blackboard-banner-with-adorable.jpg?s=1024x1024&w=is&k=20&c=Tt-ykpYpAv-JrCfyeNIrV0cpR7ife87gdhF838M9wRY="
                                                    style="max-width: 257px; max-height: 257px; margin-left: 220px"
                                                    class="profile-picture" alt="User-Image">
                                            </th>
                                        </tr>
                                        <p>
                                            Feedback:
                                            @isset($current_student->idea->comment)
                                            {{ $current_student->idea->comment->content }}
                                            @else
                                            No comment
                                            @endisset
                                        </p>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End of Table -->

                        <!-- Edit -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target=".bd-example-modal-lg" style="margin-left: 50%"><i
                                class="feather mr-2 icon-edit"></i>Edit Idea
                        </button>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Idea</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <form action="{{ route('student_edit_submit_idea', Auth::guard('student')->user()->idea->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ Auth::guard('student')->user()->id }}">

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Topic</label>
                                                        <input type="text" class="form-control" placeholder="Enter Title" name="topic" value="{{ Auth::guard('student')->user()->idea->topic }}">
                                                        @error('topic')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror

                                                        <label>Tag#</label>
                                                        <input type="text" class="form-control" placeholder="Enter Tag#" name="tag" value="{{ Auth::guard('student')->user()->idea->tag }}">
                                                        @error('tag')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror

                                                        <label>Current File: </label>
                                                        <p>{{ Auth::guard('student')->user()->idea->file }}</p>
                                                        <label>Upload Files</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="inputGroupFile01" name="file">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                file ( .docx, JPG and PNG only)</label>
                                                            @error('file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">I have read and
                                                            agreed to the <a href="#!" type="button" data-toggle="modal"
                                                                data-target="#exampleModalCenter">Term of Conditions</a></label>
                                                        <div id="exampleModalCenter" class="modal fade" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                            Terms and Conditions for Submitting a Post
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-0" style="word-wrap: break-word;">By
                                                                            submitting a post to the university platform, you
                                                                            agree to adhere to the following terms and
                                                                            conditions:</p>
        
                                                                        <p>1. <b>Originality: You certify that the content
                                                                                submitted is your original work and does not
                                                                                infringe upon the intellectual property rights
                                                                                of any third party.</p></b>
        
                                                                        <p>2. <b>Accuracy: You warrant that all information
                                                                                provided in the post is accurate and truthful to
                                                                                the best of your knowledge.</p></b>
        
                                                                        <p>3. <b>Respect: You agree to maintain a respectful
                                                                                tone in your post, refraining from any language
                                                                                or content that is defamatory, discriminatory,
                                                                                or offensive.</p></b>
        
                                                                        <p>4. <b>Appropriateness: You acknowledge that the
                                                                                university platform is intended for academic
                                                                                discourse and will refrain from posting content
                                                                                that is inappropriate, including but not limited
                                                                                to, content of a sexual, violent, or explicit
                                                                                nature.</p></b>
        
                                                                        <p>5. <b>Copyright: You grant the university a
                                                                                non-exclusive, royalty-free, perpetual, and
                                                                                worldwide license to use, reproduce, modify,
                                                                                adapt, publish, translate, distribute, and
                                                                                display the content submitted in any medium or
                                                                                format.</p></b>
        
                                                                        <p>6. <b>Privacy: You will not disclose any personal or
                                                                                sensitive information of yourself or others in
                                                                                your post without their explicit consent.</p>
                                                                        </b>
        
                                                                        <p>7. <b>Compliance: You agree to comply with all
                                                                                university policies, including but not limited
                                                                                to, policies on academic integrity, conduct, and
                                                                                acceptable use of technology.</p></b>
        
                                                                        <p>8. <b>Responsibility: You acknowledge that you are
                                                                                solely responsible for the content you submit
                                                                                and any consequences that may arise from its
                                                                                publication.</p></b>
        
                                                                        <p>9. <b>Indemnity: You agree to indemnify and hold the
                                                                                university harmless from any claims, damages,
                                                                                losses, or liabilities arising out of or related
                                                                                to your submission, including but not limited
                                                                                to, claims of copyright infringement,
                                                                                defamation, or violation of privacy rights.</p>
                                                                        </b>
        
                                                                        <p>10. <b>Moderation: The university reserves the right
                                                                                to moderate, edit, or remove any content
                                                                                submitted to the platform that violates these
                                                                                terms and conditions or is otherwise deemed
                                                                                inappropriate.<br></b>
        
                                                                        <p>11. <b>Termination: The university reserves the right
                                                                                to suspend or terminate your access to the
                                                                                platform in the event of repeated violations of
                                                                                these terms and conditions.</p></b>
        
                                                                        <p>By submitting a post to the university platform, you
                                                                            acknowledge that you have read, understood, and
                                                                            agree to be bound by these terms and conditions.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn  btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End of Edit -->
                        <br><br>

                        <!-- Comment -->

                        @endsection