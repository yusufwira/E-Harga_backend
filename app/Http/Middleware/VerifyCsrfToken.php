<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login/','logout',
        'user/','user/update','user/delete','user/showdetail',
        'ssh/','ssh/update','ssh/delete','ssh/count','ssh/search',
        'sbu/','sbu/update','sbu/delete','sbu/count','sbu/search',
        'hspk/','hspk/update','hspk/delete','hspk/ssh','hspk/sbu','hspk/harga','hspk/count','hspk/limit','hspk/search',
        'asb/','asb/update','asb/delete','asb/ssh','asb/hspk','asb/harga','asb/count','asb/search',
        'pengumuman/','pengumuman/update',
        'usulan/','usulan/update','suratUsulan/','downloadSuratUsulan/', 'usersusulan/',
        'usulan/jumlah','usulanbaru/','usulanbaru/update','usulanbaru/delete','usulanbaru/count',
        'usulanbaru/updatestatus','usulanbarupenyusun/','usulanbarupenyusun/count', 
        'notif/','notif/tampil',                 
    ];
}
