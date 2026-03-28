<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $address_type
 * @property string $zip
 * @property string $settlement
 * @property string $street
 * @property string $street_type
 * @property string $house_number
 * @property string|null $floor_number
 * @property string|null $door_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAddressType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDoorNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereFloorNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereSettlement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereZip($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property string $condition
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InstrumentBrand $brand
 * @property-read \App\Models\InstrumentCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instrument whereUpdatedAt($value)
 */
	class Instrument extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $brand_name
 * @property string|null $brand_desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Instrument> $instruments
 * @property-read int|null $instruments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand whereBrandDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentBrand whereUpdatedAt($value)
 */
	class InstrumentBrand extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $category_name
 * @property string|null $category_desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Instrument> $instruments
 * @property-read int|null $instruments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory whereCategoryDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InstrumentCategory whereUpdatedAt($value)
 */
	class InstrumentCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $instrument_id
 * @property int $rent_price
 * @property string $start_date
 * @property string $end_date
 * @property string $real_end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $0
 * @property mixed $1
 * @property mixed $2
 * @property-read \App\Models\Instrument $instrument
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereInstrumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereRealEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereRentPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rent whereUserId($value)
 */
	class Rent extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

