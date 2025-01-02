

<?php $__env->startSection('content'); ?>

	<div class="login-box">
		<div class="login-logo">
			<a href="../../index2.html"><b>Admin</b></a>
		</div>

		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Masukan Akun Anda</p>
					<form method="POST" action="<?php echo e(route('login')); ?>">
						<?php echo csrf_field(); ?>
					<div class="input-group mb-3">

						 <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

	                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong><?php echo e($message); ?></strong>
	                                    </span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

					<div class="input-group-append">
					<div class="input-group-text">
					<span class="fas fa-envelope"></span>
					</div>
					</div>
					</div>
					<div class="input-group mb-3">
						
						  <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

	                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong><?php echo e($message); ?></strong>
	                                    </span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

					<div class="input-group-append">
					<div class="input-group-text">
					<span class="fas fa-lock"></span>
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-8">
					<div class="icheck-primary">
						
						 <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

	                                    <label class="form-check-label" for="remember">
	                                        Ingatkan Saya
	                                    </label>

					</div>
					</div>

					<div class="col-4">
					<button type="submit" class="btn btn-primary btn-block">Masuk</button>
					</div>

					</div>
				</form>

				<p class="mb-1">
				<a href="forgot-password.html">Lupa Kata Sandi</a>
				</p>
				<p class="mb-0">
				<a href="register.html" class="text-center">Daftar di Sini</a>
				</p>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eduwork\prewedding\resources\views/auth/login.blade.php ENDPATH**/ ?>