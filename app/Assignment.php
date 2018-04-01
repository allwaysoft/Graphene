<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        "user_id", "device_id", "modify"
    ];

    /**
     * Get Modify boolean for the assignment.
     *
     * @return mixed
     */
    public function canModify()
    {
        return $this->modify;
    }

    /**
     * Assign device to user
     *
     * @param User $user
     * @param Device $device
     * @param bool $canModify
     * @return Assignment
     */
    public static function assignDeviceToUser(User $user, Device $device, bool $canModify): self
    {
        return self::create([
            "user_id" => $user->id,
            "device_id" => $device->id,
            "modify" => $canModify
        ]);
    }

    /**
     * Delete all assignments for a device.
     *
     * @param Device $device
     * @return mixed
     */
    public static function deleteDeviceAssignments(Device $device)
    {
        return self::where('device_id', $device->id)->delete();
    }

    /**
     * Delete all assignments for a user.
     *
     * @param User $user
     * @return mixed
     */
    public static function deleteUserAssignments(User $user)
    {
        return self::where('user_id', $user->id)->delete();
    }

    /**
     * Static getter to determine if a user can modify the device.
     *
     * @param User $user
     * @param Device $device
     * @return bool
     */
    public static function canUserModify(User $user, Device $device)
    {
        if ($data = self::where(["user_id" => $user->id, "device_id" => $device->id])->first()) {
            return $data->canModify();
        } else {
            return false;
        }
    }

}
