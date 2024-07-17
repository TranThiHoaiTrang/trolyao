<div class="section add_this-section">
	<ul class="add_this">
		<li>
			<a class="add_this-inner" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>" target="_blank" title="" aria-label="Hotline">
				<svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="22" cy="22" r="22" fill="url(#paint2_linear)"></circle>
					<path fill-rule="evenodd" clip-rule="evenodd" d="M14.0087 9.35552C14.1581 9.40663 14.3885 9.52591 14.5208 9.61114C15.3315 10.148 17.5888 13.0324 18.3271 14.4726C18.7495 15.2949 18.8903 15.9041 18.758 16.3558C18.6214 16.8415 18.3953 17.0971 17.384 17.9109C16.9786 18.239 16.5988 18.5756 16.5391 18.6651C16.3855 18.8866 16.2617 19.3212 16.2617 19.628C16.266 20.3395 16.7269 21.6305 17.3328 22.6232C17.8021 23.3944 18.6428 24.3828 19.4749 25.1413C20.452 26.0361 21.314 26.6453 22.2869 27.1268C23.5372 27.7488 24.301 27.9064 24.86 27.6466C25.0008 27.5826 25.1501 27.4974 25.1971 27.4591C25.2397 27.4208 25.5683 27.0202 25.9268 26.5772C26.618 25.7079 26.7759 25.5674 27.2496 25.4055C27.8513 25.201 28.4657 25.2563 29.0844 25.5716C29.5538 25.8145 30.5779 26.4493 31.2393 26.9095C32.1098 27.5187 33.9703 29.0355 34.2221 29.3381C34.6658 29.8834 34.7427 30.5821 34.4439 31.3534C34.1281 32.1671 32.8992 33.6925 32.0415 34.3444C31.2649 34.9323 30.7145 35.1581 29.9891 35.1922C29.3917 35.222 29.1442 35.1709 28.3804 34.8556C22.3893 32.3887 17.6059 28.7075 13.8081 23.65C11.8239 21.0084 10.3134 18.2688 9.28067 15.427C8.67905 13.7696 8.64921 13.0495 9.14413 12.2017C9.35753 11.8438 10.2664 10.9575 10.9278 10.4633C12.0288 9.64524 12.5365 9.34273 12.9419 9.25754C13.2193 9.19787 13.7014 9.24473 14.0087 9.35552Z" fill="white"></path>
					<defs>
						<linearGradient id="paint2_linear" x1="22" y1="-7.26346e-09" x2="22.1219" y2="40.5458" gradientUnits="userSpaceOnUse">
							<stop offset="50%" stop-color="#fd1f36"></stop>
							<stop offset="100%" stop-color="#fd1f04"></stop>
						</linearGradient>
					</defs>
				</svg>
				<span class="title">Hotline</span>
			</a>
		</li>
		<li>
			<a class="add_this-inner" href="https://zalo.me/0832645555" target="_blank" title="" aria-label="">
				<img src="./assets/images/icon_zalo.png" alt="" width="44" height="44">
				<span class="title">zalo</span>
			</a>
		</li>
		<li>
			<a class="add_this-inner" href="<?= $optsetting['fanpage'] ?>" title="" aria-label="" target="_blank">
				<img src="./assets/images/icon_mess.png" alt="" width="44" height="44">
				<span class="title">Chat facebook</span>
			</a>
		</li>
		<li>
			<div class="add_this-inner" data-toggle="modal" data-target="#lienhetuvan">
				<img src="./assets/images/note.png" alt="" width="44" height="44">
				<span class="title">Điền thông tin</span>
			</div>
		</li>
	</ul>
	<div class="close_phone">
		<div class="icon_close_phone"><i class="fas fa-angle-down"></i></div>
	</div>
</div>

<!-- Liên hệ tư vấn -->
<div class="modal fade" id="lienhetuvan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fas fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="all_tuvan_pro">
					<div class="content_tuvan">
						<div class="content_top content_top_des">
							<span>Bạn muốn được tư vấn thêm về sản phẩm 👋</span>
							<span>Hãy để lại thông tin của bạn ở đây nhé! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</span>
						</div>

					</div>
					<div class="from_tuvan">
						<div class="title_form_tuvan">Hãy điền form bên dưới</div>
						<form class="form-contact validation-contact d-flex align-items-center flex-column" novalidate method="post" action="" enctype="multipart/form-data">
							<input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
							<div class="input-contact_index">
								<div>Họ và tên <span class="danger">*</span></div>
								<input type="text" class="form-control" id="ten_modal" name="ten" placeholder="Nhập họ và tên" required />
							</div>
							<div class="input-contact_index">
								<div>Số điện thoại <span class="danger">*</span></div>
								<input type="number" class="form-control" id="dienthoai_modal" name="dienthoai" placeholder="Nhập số điện thoại"  />
							</div>
							<div class="input-contact_index">
								<div>Loại vải cần tư vấn <span class="danger">*</span></div>
								<input type="text" class="form-control" id="tieude_modal" name="tieude" placeholder="Loại vải cần tư vấn" required />
							</div>
							<div class="input-contact_index">
								<div>Ghi chú </div>
								<textarea class="form-control" id="noidung_modal" name="noidung" placeholder="Để lại lời nhắn" /></textarea>
							</div>
							<input type="submit" class="btn btn-primary btn_contactindex" name="submit-contact" value="Gửi" disabled />
							<input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>