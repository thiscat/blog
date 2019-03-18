<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DaoModule extends Model
{
    protected $table = 'daomodule';
    protected $fillable = [
        'id', 'name', 'type', 'height', 'width', 'createTime', 'updateTime', 'isBan', 'remark',
    ];
    public $timestamps = false;

    /**
     * 返回 published_at 字段的日期部分
     */
    public function getPublishDateAttribute($value)
    {
        return $this->createTime->format('Y-m-d');
    }

    /**
     * 返回 published_at 字段的时间部分
     */
    public function getPublishTimeAttribute($value)
    {
        return $this->createTime->format('g:i A');
    }

    /**
     * Return URL to post
     *
     * @param Tag $tag
     * @return string
     */
    public function url(Tag $tag = null)
    {
        $url = url('blog/daoModule/' . $this->id);

        return $url;
    }

    /**
     * Return next post after this one or null
     *
     * @param Tag $tag
     * @return Post
     */
    public function newerPost(Tag $tag = null)
    {
        $query =
            static::where('createTime', '>', $this->createTime)
                ->where('createTime', '<=', Carbon::now())
                ->where('isBan', 0)
                ->orderBy('createTime', 'asc');

        return $query->first();
    }

    /**
     * Return older post before this one or null
     *
     * @param Tag $tag
     * @return Post
     */
    public function olderPost(Tag $tag = null)
    {
        $query =
            static::where('createTime', '<', $this->createTime)
                ->where('isBan', 0)
                ->orderBy('createTime', 'desc');

        return $query->first();
    }
}
