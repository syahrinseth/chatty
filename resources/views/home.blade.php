@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 480px" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="chat-container">
                        @if(count($chats)==0)
                            <p>There is no chat yet.</p>
                        @endif
                        @foreach($chats as $chat )
                            @if($chat->sender_id === auth()->user()->id)
                                <p class="chat chat-right">
                                    <b>{{$chat->sender_name}} :</b><br>
                                    {{$chat->message}}                                    </p>
                            @else
                                <p class="chat chat-left">
                                    <b>{{$chat->sender_name}} :</b><br>
                                    {{$chat->message}}
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label>Message</label>
                    <input type="text" name="message" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">SEND MESSAGE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Retrieve Firebase Messaging object.
    // const messaging = firebase.messaging();
    // Add the public key generated from the console here.
    messaging.usePublicVapidKey("BA3gvvv3B5qp6kpiWmoOLewhUIcBxVYDdzLj38w_57mFgSojPoITv6i3kEIpEzqZx0qIh5En1hSDwiTgziLyc1Q");
    function sendTokenToServer(fcm_token) {
        const user_id = '{{auth()->user()->id}}';
        console.log($user_id);
        axios.post('/api/save-token', {
            fcm_token, user_id
        })
            .then(res => {
                console.log(res);
            })

    }

    function retreiveToken(){
        messaging.getToken({vapidKey: "BA3gvvv3B5qp6kpiWmoOLewhUIcBxVYDdzLj38w_57mFgSojPoITv6i3kEIpEzqZx0qIh5En1hSDwiTgziLyc1Q"}).then((currentToken) => {
            if (currentToken) {
                sendTokenToServer(currentToken);
                console.log('Token sended to server.');
                // updateUIForPushEnabled(currentToken);
            } else {
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                //updateUIForPushPermissionRequired();
                //etTokenSentToServer(false);
                alert('You should allow notification!');
            }
        }).catch((err) => {
            console.log(err.message);
            // showToken('Error retrieving Instance ID token. ', err);
            // setTokenSentToServer(false);
        });
    }
    retreiveToken();
    messaging.onTokenRefresh(()=>{
        retreiveToken();


    });

    messaging.onMessage((payload)=>{
        console.log('Message received');
        console.log(payload);

        location.reload();
    });
</script>
@endsection

