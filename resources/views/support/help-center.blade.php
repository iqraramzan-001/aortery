@extends('front.layouts.layout')
@section('title','Help Center')
@section('content')
    <section class="support py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                    <h class="h3 wow animated fadeInDown fw-bold">Help <span class="text-purple">Center</span></h>
                </div>
            </div>
            <div class="row align-items-stretch mt-4">
                <div class="col-md-6 my-4">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        <h3 class="h5 fw-bold animated wow fadeInDown">FAQs</h3>
                        <hr />
                        <div class="accordion mt-4" id="accordionExample">
                            <div class="accordion-item wow animated fadeInDown my-4 border rounded-2 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How can i reset my password?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-2">
                                        <ul>
                                            <li type="1" class="fs-13 py-2 ms-2">Open your Google Account. You might need to sign in.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">At the top left, click Security.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">In the section "How you sign in to Google" click Password. You might need to sign in again.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">Enter your new password, then select Change Password.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow animated fadeInDown my-4 border rounded-2 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Where can i find my order history?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-2">
                                        <ul>
                                            <li type="1" class="fs-13 py-2 ms-2">Open your Google Account. You might need to sign in.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">At the top left, click Security.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">In the section "How you sign in to Google" click Password. You might need to sign in again.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">Enter your new password, then select Change Password.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow animated fadeInDown my-4 border rounded-2 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How do i contact customer support?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-2">
                                        <ul>
                                            <li type="1" class="fs-13 py-2 ms-2">Open your Google Account. You might need to sign in.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">At the top left, click Security.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">In the section "How you sign in to Google" click Password. You might need to sign in again.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">Enter your new password, then select Change Password.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow animated fadeInDown my-4 border rounded-2 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        What is the return policy?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-2">
                                        <ul>
                                            <li type="1" class="fs-13 py-2 ms-2">Open your Google Account. You might need to sign in.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">At the top left, click Security.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">In the section "How you sign in to Google" click Password. You might need to sign in again.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">Enter your new password, then select Change Password.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow animated fadeInDown my-4 border rounded-2 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        How do i update my billing information?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-2">
                                        <ul>
                                            <li type="1" class="fs-13 py-2 ms-2">Open your Google Account. You might need to sign in.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">At the top left, click Security.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">In the section "How you sign in to Google" click Password. You might need to sign in again.</li>
                                            <li type="1" class="fs-13 py-2 ms-2">Enter your new password, then select Change Password.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-4 wow animated fadeInDown">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        <h3 class="h5 fw-bold animated wow fadeInDown">Contact Us</h3>
                        <hr />
                        <form action="{{route('contact')}}" method="post">
                           @csrf

                        <div class="my-4 wow animated fadeInDown">
                            <label class="form-label">Your Name</label>
                            <input name="name" type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: John Doe" />
                        </div>
                        <div class="my-4 wow animated fadeInDown">
                            <label class="form-label">Your Email</label>
                            <input name="email" type="email" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: johndoe@test.com" />
                        </div>
                        <div class="my-4 wow animated fadeInDown">
                            <label class="form-label">Issue Type</label>
                            <select name="issue_type" class="form-select p-3 rounded-pill shadow-none">
                                <option>--Please Select--</option>
                                <option value="CIT Support" selected>CIT Support</option>
                                <option value="Order Support ">Order Support</option>
                                <option value="Complaints">Complaints</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="my-4 wow animated fadeInDown">
                            <label class="form-label">Your Message</label>
                            <textarea name="message" class="form-control p-3 shadow-none" placeholder="Example: Describe your concern in details" rows="4"></textarea>
                        </div>
                        <div class="form-check my-4 wow animated fadeInDown lh-150 fs-14">
                            <input class="form-check-input" type="checkbox" value="" id="agree" />
                            <label class="form-check-label" for="agree">By submitting this form, you agree to the processing data according to our <a href="privacy-policy.html" class="text-purple">Privacy Policy</a></label>
                        </div>
                        <div class="my-4 wow animated fadeInDown">
                            <button name="btn" type="submit" class="btn btn-blue p-3 px-5 rounded-pill">Submit</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
