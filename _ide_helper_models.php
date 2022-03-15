<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BeritaDanAktivitas
 *
 * @property string $id
 * @property string|null $judul_berita
 * @property string|null $isi_berita
 * @property string|null $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $users_username
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas query()
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereIsiBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereJudulBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BeritaDanAktivitas whereUsersUsername($value)
 */
	class BeritaDanAktivitas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HasilSubKriteria
 *
 * @property string $pemain_id
 * @property int $sub_kriteria_id
 * @property string|null $musim
 * @property int|null $jumlah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria whereMusim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria wherePemainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria whereSubKriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasilSubKriteria whereUpdatedAt($value)
 */
	class HasilSubKriteria extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Klub
 *
 * @property string $id
 * @property string|null $nama_klub
 * @property string|null $tgl_berdiri
 * @property string|null $alamat
 * @property string|null $notelp
 * @property string|null $jadwal_latihan
 * @property string|null $sejarah_klub
 * @property string|null $img
 * @property string $users_username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kontrak[] $kontrak_pemain
 * @property-read int|null $kontrak_pemain_count
 * @property-read \App\Models\StrukturKlub|null $struktur_klub
 * @method static \Illuminate\Database\Eloquent\Builder|Klub newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Klub newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Klub query()
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereJadwalLatihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereNamaKlub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereNotelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereSejarahKlub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereTglBerdiri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Klub whereUsersUsername($value)
 */
	class Klub extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kontrak
 *
 * @property string|null $gaji
 * @property string|null $awal_kontrak
 * @property string|null $akhir_kontrak
 * @property string|null $foto_kontrak
 * @property string $klub_id
 * @property string $pemain_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereAkhirKontrak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereAwalKontrak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereFotoKontrak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereGaji($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereKlubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak wherePemainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontrak whereUpdatedAt($value)
 */
	class Kontrak extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kriteria
 *
 * @property int $id
 * @property string|null $nama_kriteria
 * @property string|null $jenis
 * @property float|null $bobot
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubKriteria[] $sub_kriteria
 * @property-read int|null $sub_kriteria_count
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria whereBobot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kriteria whereNamaKriteria($value)
 */
	class Kriteria extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pemain
 *
 * @property string $id
 * @property string|null $nama_pemain
 * @property string|null $tempat
 * @property string|null $tgl_lahir
 * @property string|null $alamat
 * @property string|null $notelp
 * @property string|null $tinggi
 * @property string|null $berat
 * @property string|null $status
 * @property string|null $nama_klub
 * @property string|null $posisi
 * @property string|null $img
 * @property string $users_username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HasilSubKriteria[] $hasil_sub_kriteria
 * @property-read int|null $hasil_sub_kriteria_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kontrak[] $kontrak_klub
 * @property-read int|null $kontrak_klub_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereBerat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNamaKlub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNamaPemain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereNotelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain wherePosisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereTempat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereTglLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereTinggi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemain whereUsersUsername($value)
 */
	class Pemain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pesan
 *
 * @property string $id
 * @property string|null $isi_pesan
 * @property string $dari_username
 * @property string $kepada_username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereDariUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereIsiPesan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereKepadaUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereUpdatedAt($value)
 */
	class Pesan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StrukturKlub
 *
 * @property string $id
 * @property string|null $nama_sk
 * @property string|null $notelp
 * @property string|null $jabatan
 * @property string|null $img
 * @property string $klub_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub query()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereKlubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereNamaSk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereNotelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturKlub whereUpdatedAt($value)
 */
	class StrukturKlub extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubKriteria
 *
 * @property int $id
 * @property string|null $nama_sub_kriteria
 * @property float|null $bobot
 * @property int $kriteria_id
 * @property int|null $Min_Max Min = 0, Max = 1
 * Goal = Max
 * Asis = Max
 * Kartu Kuning & Merah = Min
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HasilSubKriteria[] $hasil_sub_pemain
 * @property-read int|null $hasil_sub_pemain_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria whereBobot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria whereKriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria whereMinMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubKriteria whereNamaSubKriteria($value)
 */
	class SubKriteria extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property string $username
 * @property string|null $password
 * @property string|null $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BeritaDanAktivitas[] $berita_dan_aktivitas
 * @property-read int|null $berita_dan_aktivitas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Klub[] $klub
 * @property-read int|null $klub_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pemain[] $pemain
 * @property-read int|null $pemain_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pemain[] $pesan
 * @property-read int|null $pesan_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

