<?php

namespace App\Model;

enum WeatherCondition : int
{
    case THUNDERSTORM_WITH_LIGHT_RAIN = 200;
    case THUNDERSTORM_WITH_RAIN = 201;
    case THUNDERSTORM_WITH_HEAVY_RAIN = 202;
    case LIGHT_THUNDERSTORM = 210;
    case THUNDERSTORM = 211;
    case HEAVY_THUNDERSTORM = 212;
    case RAGGED_THUNDERSTORM = 221;
    case THUNDERSTORM_WITH_LIGHT_DRIZZLE = 230;
    case THUNDERSTORM_WITH_DRIZZLE = 231;
    case THUNDERSTORM_WITH_HEAVY_DRIZZLE = 232;
    case LIGHT_INTENSITY_DRIZZLE = 300;
    case DRIZZLE = 301;
    case HEAVY_INTENSITY_DRIZZLE = 302;
    case LIGHT_INTENSITY_DRIZZLE_RAIN = 310;
    case DRIZZLE_RAIN = 311;
    case HEAVY_INTENSITY_DRIZZLE_RAIN = 312;
    case SHOWER_RAIN_AND_DRIZZLE = 313;
    case HEAVY_SHOWER_RAIN_AND_DRIZZLE = 314;
    case SHOWER_DRIZZLE = 321;
    case LIGHT_RAIN = 500;
    case MODERATE_RAIN = 501;
    case HEAVY_INTENSITY_RAIN = 502;
    case VERY_HEAVY_RAIN = 503;
    case EXTREME_RAIN = 504;
    case FREEZING_RAIN = 511;
    case LIGHT_INTENSITY_SHOWER_RAIN = 520;
    case SHOWER_RAIN = 521;
    case HEAVY_INTENSITY_SHOWER_RAIN = 522;
    case RAGGED_SHOWER_RAIN = 531;
    case LIGHT_SNOW = 600;
    case SNOW = 601;
    case HEAVY_SNOW = 602;
    case SLEET = 611;
    case LIGHT_SHOWER_SLEET = 612;
    case SHOWER_SLEET = 613;
    case LIGHT_RAIN_AND_SNOW = 615;
    case RAIN_AND_SNOW = 616;
    case LIGHT_SHOWER_SNOW = 620;
    case SHOWER_SNOW = 621;
    case HEAVY_SHOWER_SNOW = 622;
    case MIST = 701;
    case SMOKE = 711;
    case HAZE = 721;
    case DUST_WHIRLS = 731;
    case FOG = 741;
    case SAND = 751;
    case DUST = 761;
    case VOLCANIC_ASH = 762;
    case SQUALLS = 771;
    case TORNADO = 781;
    case CLEAR_SKY = 800;
    case FEW_CLOUDS = 801;
    case SCATTERED_CLOUDS = 802;
    case BROKEN_CLOUDS = 803;
    case OVERCAST_CLOUDS = 804;
}