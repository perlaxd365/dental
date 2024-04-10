<?php
use chillerlan\QRCode as qr;
use chillerlan\Settings\SettingsContainerInterface;
use RobThree\Auth\Providers\Qr as mfa;

class ChillerlanQRCodeProvider extends qr\QRCode  {

	function __construct( SettingsContainerInterface $options = NULL ) {
		$options ??= new qr\QROptions( [
			'outputType' => qr\QRCode::OUTPUT_MARKUP_SVG,
			'eccLevel' => qr\QRCode::ECC_M,
		] );
		$options->imageBase64 = False;	// imageBase64 above must always be False. Override if necessary.
		parent::__construct( $options );
	}

	public function getQRCodeImage( string $qrtext, int $size ): string {
		return self::render( $qrtext );
	}

	public function getMimeType(): string {
		return match( $this->options->outputType ) {
			self::OUTPUT_MARKUP_SVG=>'image/svg+xml',
			self::OUTPUT_IMAGE_PNG=>'image/png',
			self::OUTPUT_IMAGE_JPG=>'image/jpeg',
			self::OUTPUT_IMAGE_GIF=>'image/gif',
		};
	}
}