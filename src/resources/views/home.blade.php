@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					You are logged in!

						<div id="container">

							<div id="center-container">
								<div id="infovis"></div>    
							</div>

							<div id="right-container">
								<h4>Tree Orientation</h4>
								<table>
									<tr>
										<td>
											<label for="r-left">Left </label>
										</td>
										<td>
											<input type="radio" id="r-left" name="orientation" checked="checked" value="left" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="r-top">Top </label>
										</td>
										<td>
											<input type="radio" id="r-top" name="orientation" value="top" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="r-bottom">Bottom </label>
										</td>
										<td>
											<input type="radio" id="r-bottom" name="orientation" value="bottom" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="r-right">Right </label>
										</td> 
										<td> 
										 <input type="radio" id="r-right" name="orientation" value="right" />
										</td>
									</tr>
								</table>

								<h4>Selection Mode</h4>
								<table>
									<tr>
										<td>
											<label for="s-normal">Normal </label>
										</td>
										<td>
											<input type="radio" id="s-normal" name="selection" checked="checked" value="normal" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="s-root">Set as Root </label>
										</td>
										<td>
											<input type="radio" id="s-root" name="selection" value="root" />
										</td>
									</tr>
								</table>
							</div>

							<div id="log"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
