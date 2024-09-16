@extends('layouts.dashboard')
@section('content')
    <div class="p-2 overflow-hidden h-full">

        <div class="flex justify-center items-center h-full">
            <button id="liffBtn" class="bg-line text-white text-center inline-flex justify-center items-center p-2 rounded w-60 shadow">
                เข้าสู่ระบบด้วยบัญชี LINE
            </button>

        </div>

    </div>

    <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>


    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.22.3/sdk.js"></script>
    <script>
        const liffBtn = document.getElementById('liffBtn');
        var liffId = "{{ env('LINE_LIFF_ID') }}";
        liffBtn.addEventListener('click', function () {
            logIn();
        })

        const liffInit = async () => {
            liff.init({ liffId })
            .then(async () => {
                if (liff.isLoggedIn()) {
                console.log(liff.getProfile());
                } else {
                liff.login();
                }
            })
        }

        const logIn = async () => {

            await liff.init({ liffId });
            // const profile = await liff.getProfile();
            // console.log(profile);
            const getAccessToken = await liff.getAccessToken();
            // console.log(getAccessToken);


            // ทดสอบ Decode
            const endpoint = `https://api.line.me/oauth2/v2.1/verify`
            const verify = await axios.get(
                `${endpoint}?access_token=${getAccessToken}`
            );
            // console.log('verify',verify.data)

            if(verify.status !== 200){
                return false
            }

            const profileAuth = await axios.get(
                `https://api.line.me/v2/profile`, {
                headers: { Authorization: `Bearer ${getAccessToken}` }
            });

            // console.log('profileAuth',profileAuth.data);

            const auth = await axios.post(
                '{{ env('AUTH_URI') }}', {
                    token : getAccessToken
                }
            )
            // console.log('auth',auth);
            if(auth.status == 200){
                window.location.href = '{{ route('home') }}'
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // logIn();
            liffInit();
        })



    </script>


@endsection
