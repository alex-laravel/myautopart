<?php


namespace App\Http\Controllers\Backend\TecDoc;

use App\Http\Controllers\Controller;

class TecDocController extends Controller
{
    const TEC_DOC_TARGET_TYPE_PASSENGER = 'P';
    const TEC_DOC_TARGET_TYPE_COMMERCIAL = 'O';
    const TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT = 'L';
    const TEC_DOC_TARGET_TYPE_AXLES = 'A';
    const TEC_DOC_TARGET_TYPE_MOTOR = 'M';
    const TEC_DOC_TARGET_TYPE_BODY = 'K';
    const TEC_DOC_TARGET_TYPE_UNIVERSAL = 'U';

    const TEC_DOC_TARGET_TYPE_ALL = 0; // ???
    const TEC_DOC_TARGET_TYPE_V = 'V'; // ???

    /**
     * @var string[]
     */
    public static $allowedTargetTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT,
        self::TEC_DOC_TARGET_TYPE_AXLES,
        self::TEC_DOC_TARGET_TYPE_MOTOR,
        self::TEC_DOC_TARGET_TYPE_BODY,
        self::TEC_DOC_TARGET_TYPE_UNIVERSAL
    ];

    /**
     * @var string[]
     */
    public static $allowedShortCutsTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_UNIVERSAL
    ];

    /**
     * @var string[]
     */
    public static $allowedVehicleTargetTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT
    ];

    /**
     * @var string[]
     */
    public static $allowedArticleTargetTypes = [
        self::TEC_DOC_TARGET_TYPE_PASSENGER,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL,
        self::TEC_DOC_TARGET_TYPE_COMMERCIAL_LIGHT,
        self::TEC_DOC_TARGET_TYPE_UNIVERSAL
    ];
}
