<nav class="navbar ">

		<div class="d-flex">
			<button class="toggler-btn" type="button">
				<i class="lni lni-text-align-left"></i>
			</button>
			<div class="navbar-logo">
				<a href="#">Yuya</a>
			</div>
		</div>
		<div>
			@if(session('api_token'))
				{{-- <form action="{{ route('auth.logout') }}" method="POST">
					@csrf   --}}
					<button type="button" onclick="logout()"
					class="btn btn-outline-primary d-flex align-items-center gap-2 px-4 py-2 rounded-pill">
						<i class="fa-solid fa-right-to-bracket"></i> 
						<span>Logout</span>
					</button>
				{{-- </form> --}}

				<script>
					function logout() {
						axios.post("{{ route('auth.logout') }}", {}, {
							headers: {
								'Authorization': 'Bearer {{ session('api_token') }}',
								'X-Requested-With': 'XMLHttpRequest'
							}
						}).then(response => {
							window.location.href = "{{ route('auth.login') }}";
						}).catch(error => {
							console.error("Logout failed", error.response);
						});
					}

				</script>

			@else
				<button class="btn btn-outline-primary d-flex align-items-center gap-2 px-4 py-2 rounded-pill" type="button">
					<a href="{{ route('auth.login') }}" class=" text-decoration-none">
						<i class="fa-solid fa-right-to-bracket"></i> 
						<span>Login</span>
					</a>
				</button>
			@endif
		</div>
	
</nav>

{{-- <script type="module">
    import { ApiRequest } from "{{ asset('js/api.js') }}";

    function logout() {
        ApiRequest({ method: "POST", url: "/auth/logout" })
            .then(response => {
                if (response.flag) {
                    // Remove token from cookies
                    document.cookie = "api_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    window.location.href = "{{ route('auth.login') }}";
                } else {
                    console.error("Logout failed:", response.message);
                }
            })
            .catch(error => console.error("Logout error:", error));
    }
</script> --}}