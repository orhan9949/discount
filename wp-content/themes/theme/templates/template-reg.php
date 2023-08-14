<?php

/**

 * Template Name: Страница регистрации

 */

get_header();

?>
<meta name="robots" content="noindex, nofollow" />
<main class="container">
    <div class="reg">
        <div class="reg__block">
			<div class="back_img_reg">
                <img src="https://discount.one/?attachment_id=105" alt="" class="img_push_reg">
                <h1 class="registr_title"><?php the_title(); ?></h1>
                <div class="reg__form">
                    <div class="tabs_push tabs-js">
                        <div class="tabs__active"><a href="#">My account</a></div>
                        <ul>
                            <li class="" data-tab="login"><a href="#">My account</a></li>
                            <li class="active" data-tab="reg"><a href="#">New account</a></li>
                        </ul>
                    </div>
                        <div id="login" class="tab-content_push">
                        <form id="login-form">
                            <div class="field"><input type="text" name="login" placeholder="Email"></div>
                            <div class="field"><input type="password" name="password" placeholder="Password"></div>
                            <div class="field">
                                <button class="btn" type="submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div id="reg" class="tab-content_push active">
                        <form id="reg-form">
                            <div class="field" style="display:none;">
                                <a href="#" class="btn btn-google">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_34_14071" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                            <path d="M17.3599 7.23998H9.15986V10.64H13.8799C13.4399 12.8 11.5999 14.04 9.15986 14.04C6.27986 14.04 3.95986 11.72 3.95986 8.83998C3.95986 5.95998 6.27986 3.63998 9.15986 3.63998C10.3999 3.63998 11.5199 4.07999 12.3999 4.79999L14.9599 2.23998C13.3999 0.879978 11.3999 0.039978 9.15986 0.039978C4.27986 0.039978 0.359863 3.95998 0.359863 8.83998C0.359863 13.72 4.27986 17.64 9.15986 17.64C13.5599 17.64 17.5599 14.44 17.5599 8.83998C17.5599 8.31998 17.4799 7.75998 17.3599 7.23998Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_34_14071)">
                                            <path d="M-0.439941 14.04V3.63995L6.36006 8.83995L-0.439941 14.04Z" fill="#FBBC05"/>
                                        </g>
                                        <mask id="mask1_34_14071" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                            <path d="M17.3599 7.23998H9.15986V10.64H13.8799C13.4399 12.8 11.5999 14.04 9.15986 14.04C6.27986 14.04 3.95986 11.72 3.95986 8.83998C3.95986 5.95998 6.27986 3.63998 9.15986 3.63998C10.3999 3.63998 11.5199 4.07999 12.3999 4.79999L14.9599 2.23998C13.3999 0.879978 11.3999 0.039978 9.15986 0.039978C4.27986 0.039978 0.359863 3.95998 0.359863 8.83998C0.359863 13.72 4.27986 17.64 9.15986 17.64C13.5599 17.64 17.5599 14.44 17.5599 8.83998C17.5599 8.31998 17.4799 7.75998 17.3599 7.23998Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask1_34_14071)">
                                            <path d="M-0.439941 3.63999L6.36006 8.83999L9.16006 6.4L18.7601 4.83999V-0.76001H-0.439941V3.63999Z" fill="#EA4335"/>
                                        </g>
                                        <mask id="mask2_34_14071" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                            <path d="M17.3599 7.23998H9.15986V10.64H13.8799C13.4399 12.8 11.5999 14.04 9.15986 14.04C6.27986 14.04 3.95986 11.72 3.95986 8.83998C3.95986 5.95998 6.27986 3.63998 9.15986 3.63998C10.3999 3.63998 11.5199 4.07999 12.3999 4.79999L14.9599 2.23998C13.3999 0.879978 11.3999 0.039978 9.15986 0.039978C4.27986 0.039978 0.359863 3.95998 0.359863 8.83998C0.359863 13.72 4.27986 17.64 9.15986 17.64C13.5599 17.64 17.5599 14.44 17.5599 8.83998C17.5599 8.31998 17.4799 7.75998 17.3599 7.23998Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask2_34_14071)">
                                            <path d="M-0.439941 14.04L11.5601 4.83999L14.7201 5.23999L18.7601 -0.76001V18.44H-0.439941V14.04Z" fill="#34A853"/>
                                        </g>
                                        <mask id="mask3_34_14071" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                            <path d="M17.3599 7.23998H9.15986V10.64H13.8799C13.4399 12.8 11.5999 14.04 9.15986 14.04C6.27986 14.04 3.95986 11.72 3.95986 8.83998C3.95986 5.95998 6.27986 3.63998 9.15986 3.63998C10.3999 3.63998 11.5199 4.07999 12.3999 4.79999L14.9599 2.23998C13.3999 0.879978 11.3999 0.039978 9.15986 0.039978C4.27986 0.039978 0.359863 3.95998 0.359863 8.83998C0.359863 13.72 4.27986 17.64 9.15986 17.64C13.5599 17.64 17.5599 14.44 17.5599 8.83998C17.5599 8.31998 17.4799 7.75998 17.3599 7.23998Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask3_34_14071)">
                                            <path d="M18.7598 18.44L6.35977 8.83995L4.75977 7.63995L18.7598 3.63995V18.44Z" fill="#4285F4"/>
                                        </g>
                                    </svg>
                                    Sign in with Google
                                </a>
                            </div>
                            <div class="field">
                                <input type="text" name="login" placeholder="Your name">
                            </div>
                            <div class="field">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div class="field">
                                <input type="password" name="password" placeholder="Password">
                                <small>We will send you an email to confirm your registration.</small>
                            </div>
                            <div class="field">
                                <button class="btn" type="submit">Sign Up</button>
                                <small>By clicking on the "Sign Up" button, you agree <a href="/privacy-policy">with the personal data processing policy and the rules for using the service.</a></small>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
        </div>
    </div>
</main>

<?php get_footer(); ?>