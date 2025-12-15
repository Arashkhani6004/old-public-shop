<div class="avatar-upload">
	<div class="avatar-edit">
		<input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
		<label for="imageUpload"></label>
	</div>
	<div class="avatar-preview">

		<div id="imagePreview" @if($user->avatar != null) style="background: url({{asset('assets/uploads/content/users/'.$user->avatar)}}) center center; background-size: cover;" @endif>

        </div>
	</div>
</div>

