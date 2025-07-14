<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Lootraiders Account</title>
</head>

<body
    style="margin: 0; padding: 0; background: linear-gradient(to bottom, #1A0C48, #440640); font-family: Arial, sans-serif; color: #ffffff;">
    <!-- Pre-header text -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        Verify your Lootraiders account to unlock all gaming features. Click the verification link to activate your
        account.
    </div>

    <div>
        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
            style="max-width: 600px; margin: 20px auto; border-collapse: collapse;">
            <!-- Header -->
            <tr>
                <td style="padding: 0;">
                    <img src="{{ asset('assets/images/email-banner.png') }}" alt="Welcome to Lootraiders"
                        style="width: 100%; max-width: 600px; display: block; border-radius: 8px 8px 0 0; border-bottom: 1px solid #e0e0e0;">
                </td>
            </tr>

            <!-- Main Content -->
            <tr>
                <td style="background-color: #140033; padding: 30px;">
                    <h2 style="margin-top: 0; font-size: 24px; color: #ffffff;">
                        {{-- Hey <span style="color: #00cfff;">{{ $user->first_name }}</span>, --}}
                    </h2>

                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #ffffff;">
                        Thank you for joining the ultimate gaming adventure! We're excited to have you on board.
                        Before you dive in, we need to verify your email address to secure your account.
                    </p>

                    <div style="border-top: 1px solid #333; margin: 25px 0;"></div>

                    <h2 style="font-size: 20px; color: #ffffff; margin-bottom: 15px;">One Last Step Required</h2>

                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #ffffff;">
                        Please verify your email within 24 hours to activate your account and unlock all Lootraiders
                        features.
                    </p>

                    <!-- CTA Button -->
                    <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                        <tr>
                            <td align="center">
                                <a href="{{ $verifyUrl }}"
                                    style="background-color: #ae00ff;
                                          color: white;
                                          padding: 14px 28px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          font-weight: bold;
                                          font-size: 16px;
                                          display: inline-block;">
                                    Verify My Email Now
                                </a>
                            </td>
                        </tr>
                    </table>

                    <!-- Fallback Link -->
                    <p style="font-size: 14px; color: #cccccc; text-align: center; margin-bottom: 0;">
                        If the button doesn't work, copy and paste this link into your browser:<br>
                        <a href="{{ $verifyUrl }}"
                            style="color: #ae00ff; word-break: break-word;">{{ $verifyUrl }}</a>
                    </p>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td
                    style="background-color: #0b021f; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; font-size: 12px; color: #999999; border-top: 1px solid #333;">
                    <p style="margin: 0 0 10px 0;">
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Privacy
                            Policy</a>
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Terms of
                            Service</a>
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Support</a>
                    </p>
                    <p style="margin: 0;color:#ffffff">
                        © {{ date('Y') }} Lootraiders. All rights reserved.
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
