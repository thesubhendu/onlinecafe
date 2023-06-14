<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-content">
                        <h2>Contact</h2>
                        <ul class="contact-list">
                            <li>
                                <i class="fa fa-envelope"></i>  <a href="mailto:support@mycoffees.com.au">someone@example.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="bottom-footer">
        <div class="container">
            <small> 2021 © {{config('app.name')}}. All rights reserved. </small>
        | <a href="{{route('privacy')}}"><small>Privacy</small></a>
        | <a href="{{route('terms-conditions')}}"><small>Terms and Conditions</small></a>
        </div>
    </div>
</footer>
