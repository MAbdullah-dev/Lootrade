<section class="logins">
    <div class="container-fluid">
        <div class="inner">
            <div class="tab-wrapper">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 'login' ? 'active' : '' }}" id="tab1-tab"
                            wire:click="$set('activeTab', 'login')" type="button" role="tab">
                            Login
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 'register' ? 'active' : '' }}" id="tab2-tab"
                            wire:click="$set('activeTab', 'register')" type="button" role="tab">
                            Register
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabsContent">
                    {{-- Login Tab --}}
                    <div class="tab-pane fade {{ $activeTab === 'login' ? 'show active' : '' }}" id="tab1"
                        role="tabpanel">
                        <form wire:submit.prevent="login">
                            <div class="form-group">
                                <label for="login_email">Email</label>
                                <input type="email" id="login_email" wire:model.defer="login_email"
                                    name="login_email">
                                @error('login_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="login_password">Password</label>
                                <input type="password" id="login_password" wire:model.defer="login_password"
                                    name="login_password">
                                @error('login_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-btn">
                                <button type="submit">Login</button>
                            </div>

                            <div class="divider">
                                <span>OR</span>
                            </div>

                            <div class="social-login">
                                <button wire:click="redirectToGoogleLogin" type="button" class="social-btn google">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button wire:click="redirectToTwitterLogin" type="button" class="social-btn x">
                                    <i class="fab fa-x-twitter"></i>
                                </button>
                                <button wire:click="redirectToDiscordLogin" type="button" class="social-btn discord">
                                    <i class="fab fa-discord"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Register Tab --}}
                    <div class="tab-pane fade {{ $activeTab === 'register' ? 'show active' : '' }}" id="tab2"
                        role="tabpanel">
                        <form wire:submit.prevent="register">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_first_name">First Name</label>
                                        <input type="text" id="register_first_name"
                                            wire:model.debounce.500ms="register_first_name" name="register_first_name">
                                        @error('register_first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_last_name">Last Name</label>
                                        <input type="text" id="register_last_name"
                                            wire:model.debounce.500ms="register_last_name" name="register_last_name">
                                        @error('register_last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_username">Username</label>
                                        <input type="text" id="register_username"
                                            wire:model.debounce.500ms="register_username" name="register_username">
                                        @error('register_username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_email">Email</label>
                                        <input type="email" id="register_email"
                                            wire:model.debounce.500ms="register_email" name="register_email">
                                        @error('register_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_password">Password</label>
                                        <input type="password" id="register_password"
                                            wire:model.debounce.500ms="register_password" name="register_password">
                                        @error('register_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_password_confirmation">Confirm Password</label>
                                        <input type="password" id="register_password_confirmation"
                                            wire:model.debounce.500ms="register_password_confirmation"
                                            name="register_password_confirmation">
                                        @error('register_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div wire:ignore class="form-group">
                                        <label for="register_date_of_birth">Date of Birth</label>
                                        <input type="text" id="register_date_of_birth"
                                            wire:model.debounce.500ms="register_date_of_birth" class="form-control"
                                            placeholder="Select your birth date">
                                    </div>
                                    @error('register_date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-btn">
                                <button type="submit">Register</button>
                            </div>

                            <div class="divider">
                                <span>OR</span>
                            </div>

                            <div class="social-login">
                                <button wire:click="redirectToGoogleLogin" type="button" class="social-btn google">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button wire:click="redirectToTwitterLogin" type="button" class="social-btn x">
                                    <i class="fab fa-x-twitter"></i>
                                </button>
                                <button wire:click="redirectToDiscordLogin" type="button"
                                    class="social-btn discord">
                                    <i class="fab fa-discord"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
