<?php
/**
 * Created by PhpStorm.
 * User: ps
 * Date: 27/10/18
 * Time: 12:04 AM
 */

namespace Punksolid\LaravelQuadraticVoting;


use Illuminate\Foundation\Auth\User;

trait isVotable
{

    public function voters()
    {
        return $this->belongsToMany(
            User::class,
            "votes",
            'votable_id',
            'voter_id')
            ->withPivot([
                "votable_type",
                "votable_id",
                "quantity"
            ]);
    }

    public function getCountVotes(): bool
    {
        return $this->voters()->sum("quantity");
    }

    public function getVoters(): \Illuminate\Support\Collection
    {
        return $this
            ->voters()
            ->groupBy('voter_id')
            ->get();
    }
}