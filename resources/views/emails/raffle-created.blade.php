<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Raffle Announcement</title>
</head>

<body style="margin: 0; padding: 0; background: linear-gradient(to bottom, #1A0C48, #440640); font-family: Arial, sans-serif; color: #ffffff;">
    <!-- Pre-header text -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        A new raffle is live on Lootraiders! Claim your entries and win exciting prizes.
    </div>

    <div>
        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
            style="max-width: 600px; margin: 20px auto; border-collapse: collapse;">
            <!-- Header -->
            <tr>
                <td style="padding: 0;">
                    <img src="{{ asset('assets/images/raffleEmailBanner.png') }}" alt="New Raffle Live!"
                        style="width: 100%; max-width: 600px; display: block; border-radius: 8px 8px 0 0;">
                </td>
            </tr>

            <!-- Main Content -->
            <tr>
                <td style="background-color: #140033; padding: 30px;">
                    <h2 style="font-size: 24px; margin-top: 0;">🎉 A New Raffle is Live!</h2>

                    <p style="font-size: 16px; line-height: 1.6;">
                        We just launched a new raffle: <strong style="color: #00cfff;">{{ $raffle->title }}</strong>
                    </p>

                    <p style="font-size: 16px; line-height: 1.6;">
                        {{ $raffle->description }}
                    </p>

                    <div style="margin: 30px 0;">
                        <h3 style="font-size: 20px; color: #ffffff;">🎁 Prizes:</h3>
                        @foreach(json_decode($raffle->prize, true) as $index => $prize)
                            <p style="margin: 10px 0;">
                                <strong>#{{ $index + 1 }} {{ $prize['name'] ?? 'Unnamed Prize' }}</strong><br>
                                <span>{{ $prize['description'] }}</span><br>
                                @if(isset($prize['value']))
                                    <span>💰 Value: ${{ number_format($prize['value'], 2) }}</span><br>
                                @endif
                                @if(isset($prize['quantity']))
                                    <span>🎫 Quantity: {{ $prize['quantity'] }}</span>
                                @endif
                            </p>
                        @endforeach
                    </div>

                    <!-- CTA Button -->
                    <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                        <tr>
                            <td align="center">
                                <a href="{{ url('/raffle/' . $raffle->id) }}"
                                    style="background-color: #ae00ff;
                                          color: white;
                                          padding: 14px 28px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          font-weight: bold;
                                          font-size: 16px;
                                          display: inline-block;">
                                    Enter the Raffle Now
                                </a>
                            </td>
                        </tr>
                    </table>

                    <!-- Fallback Link -->
                    <p style="font-size: 14px; color: #cccccc; text-align: center;">
                        Or visit this link: <br>
                        <a href="{{ url('/raffle/' . $raffle->id) }}" style="color: #ae00ff;">
                            {{ url('/raffle/' . $raffle->id) }}
                        </a>
                    </p>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td style="background-color: #0b021f; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; font-size: 12px; color: #999999; border-top: 1px solid #333;">
                    <p style="margin: 0 0 10px;">
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Terms of Service</a>
                        <a href="#" style="color: #ae00ff; text-decoration: none; margin: 0 10px;">Support</a>
                    </p>
                    <p style="margin: 0; color: #ffffff;">
                        © {{ date('Y') }} Lootraiders. All rights reserved.
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
