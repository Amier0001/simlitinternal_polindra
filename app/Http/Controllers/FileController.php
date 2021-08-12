<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

use App\Models\Laporan_akhir;
use App\Models\Usulan_penelitian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Dokumen_wajib;
use App\Models\Mitra_sasaran;
use App\Models\Logbook;
use App\Models\Laporan_luaran;
use App\Models\Logbook_berkas;
use App\Models\Laporan_kemajuan;

class FileController extends Controller
{
    // FILE PREVIEW AND DOWNLOAD
    public function file_download($id, $file_name, $file_category)
    {
        $file_fetch = NULL;
        $file = NULL;
        $file_extension = NULL;
        $file_original_name = NULL;

        if ($file_category == "usulan") {
            $file_fetch = Dokumen_usulan::where('dokumen_usulan_penelitian_id', $id)
                ->where('dokumen_usulan_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_usulan/" . $file_fetch->dokumen_usulan_hash_name);

            $file_extension = $file_fetch->dokumen_usulan_extension;

            $file_original_name = $file_fetch->dokumen_usulan_original_name;
        } elseif ($file_category == "rab") {
            $file_fetch = Dokumen_rab::where('dokumen_rab_penelitian_id', $id)
                ->where('dokumen_rab_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_rab/" . $file_fetch->dokumen_rab_hash_name);

            $file_extension = $file_fetch->dokumen_rab_extension;

            $file_original_name = $file_fetch->dokumen_rab_original_name;
        }elseif ($file_category == "wajib") {
            $file_fetch = Dokumen_wajib::where('usulan_luaran_penelitian_id', $id)
                ->where('usulan_luaran_penelitian_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_luaran/" . $file_fetch->usulan_luaran_penelitian_hash_name);

            $file_extension = $file_fetch->usulan_luaran_penelitian_extension;

            $file_original_name = $file_fetch->usulan_luaran_penelitian_original_name; 
        }elseif ($file_category == "mitra") {
            $file_fetch = Mitra_file::where('mitra_file_mitra_sasaran_id', $id)
                ->where('mitra_sasaran_file_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_mitra/" . $file_fetch->mitra_sasaran_file_hash_name);

            $file_extension = $file_fetch->mitra_sasaran_file_extension;

            $file_original_name = $file_fetch->mitra_sasaran_file_original_name;
        } elseif ($file_category == "laporan_akhir") {
            $file_fetch = Laporan_akhir::where('laporan_akhir_id', $id)
                ->where('laporan_akhir_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/laporan_akhir/" . $file_fetch->laporan_akhir_hash_name);

            $file_extension = $file_fetch->laporan_akhir_extension;

            $file_original_name = $file_fetch->laporan_akhir_original_name;
        }elseif ($file_category == "template_dokumen") {
            $file_fetch = get_where_local_db_json("template_dokumen.json", "id", $id);

            $file = public_path("assets/file/template_dokumen/" . $file_fetch["hash_name"]);

            $file_extension = $file_fetch["extension"];

            $file_original_name = $file_fetch["original_name"];

        }elseif ($file_category == "logbook_berkas") {
            $file_fetch = Logbook_berkas::where('logbook_berkas_id', $id)
                ->where('logbook_berkas_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/logbook_berkas/" . $file_fetch->logbook_berkas_hash_name);

            $file_extension = $file_fetch->logbook_berkas_extension;

            $file_original_name = $file_fetch->logbook_berkas_original_name;
        }elseif ($file_category == "laporan_luaran") {
            $file_fetch = Laporan_luaran::where('laporan_luaran_id', $id)
                ->where('laporan_luaran_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/laporan_luaran/" . $file_fetch->laporan_luaran_hash_name);

            $file_extension = $file_fetch->laporan_luaran_extension;

            $file_original_name = $file_fetch->laporan_luaran_original_name;
        }
        elseif ($file_category == "laporan_kemajuan") {
            $file_fetch = Laporan_kemajuan::where('laporan_kemajuan_id', $id)
                ->where('laporan_kemajuan_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/laporan_kemajuan/" . $file_fetch->laporan_kemajuan_hash_name);

            $file_extension = $file_fetch->laporan_kemajuan_extension;

            $file_original_name = $file_fetch->laporan_kemajuan_original_name;

            } else {
            return redirect()->route('coming_soon');
        }

        if ($file_fetch) {
            // if ($file_extension == "pdf") {

                $headers = array(
                    'Content-Type' => mime_content_type($file),
                );

                return response()->download($file, $file_original_name, $headers);
            //}
        }

        return redirect()->back();
    }

    //End File Donwnload


    //File Preview
    public function file_preview($id, $file_name, $file_category)
    {
        $file_fetch = NULL;
        $file = NULL;
        $file_extension = NULL;
        $file_url = NULL;

        if ($file_category == "usulan") {
            $file_fetch = Dokumen_usulan::where('dokumen_usulan_penelitian_id', $id)
                ->where('dokumen_usulan_hash_name', $file_name)
                ->first();

            $file_url = URL::asset("assets/file/dokumen_usulan/" . $file_fetch->dokumen_usulan_hash_name);
            $file = public_path("assets/file/dokumen_usulan/" . $file_fetch->dokumen_usulan_hash_name);

            $file_extension = $file_fetch->dokumen_usulan_extension;
        } elseif ($file_category == "rab") {
            $file_fetch = Dokumen_rab::where('dokumen_rab_penelitian_id', $id)
                ->where('dokumen_rab_hash_name', $file_name)
                ->first();
            $file_url = URL::asset("assets/file/dokumen_rab/" . $file_fetch->dokumen_rab_hash_name);
            $file = public_path("assets/file/dokumen_rab/" . $file_fetch->dokumen_rab_hash_name);

            $file_extension = $file_fetch->dokumen_rab_extension;
        }
        elseif ($file_category == "mitra") {
            $file_fetch = Mitra_file::where('mitra_file_mitra_sasaran_id ', $id)
                ->where('mitra_sasaran_file_hash_name', $file_name)
                ->first();
            $file_url = URL::asset("assets/file/dokumen_mitra/" . $file_fetch->mitra_sasaran_file_hash_name);
            $file = public_path("assets/file/dokumen_mitra/" . $file_fetch->mitra_sasaran_file_hash_name);

            $file_extension = $file_fetch->mitra_sasaran_file_extension;
        } elseif ($file_category == "laporan_akhir") {
            $file_fetch = Laporan_akhir::where('laporan_akhir_id', $id)
                ->where('laporan_akhir_hash_name', $file_name)
                ->first();

                $file_url = URL::asset("assets/file/laporan_akhir/" . $file_fetch->laporan_akhir_hash_name);
            $file = public_path("assets/file/laporan_akhir/" . $file_fetch->laporan_akhir_hash_name);

            $file_extension = $file_fetch->laporan_akhir_extension;
        }elseif ($file_category == "template_dokumen") {
            $file_fetch = get_where_local_db_json("template_dokumen.json", "id", $id);

            $file_url = URL::asset("assets/file/template_dokumen/" . $file_fetch["hash_name"]);
            $file = public_path("assets/file/template_dokumen/" . $file_fetch["hash_name"]);

            $file_extension = $file_fetch["extension"];

            $file_original_name = $file_fetch["original_name"];
        }
        elseif ($file_category == "logbook_berkas") {
            $file_fetch = Logbook_berkas::where('logbook_berkas_id', $id)
                ->where('logbook_berkas_hash_name', $file_name)
                ->first();
            $file_url = URL::asset("assets/file/logbook_berkas/" . $file_fetch->logbook_berkas_hash_name);
            $file = public_path("assets/file/logbook_berkas/" . $file_fetch->logbook_berkas_hash_name);

            $file_extension = $file_fetch->logbook_berkas_extension;

        }elseif ($file_category == "laporan_luaran") {
            $file_fetch = Laporan_luaran::where('laporan_luaran_id', $id)
                ->where('laporan_luaran_hash_name', $file_name)
                ->first();

            $file_url = URL::asset("assets/file/laporan_luaran/" . $file_fetch->laporan_luaran_hash_name);
            $file = public_path("assets/file/laporan_luaran/" . $file_fetch->laporan_luaran_hash_name);

            $file_extension = $file_fetch->laporan_luaran_extension;
        } 
        elseif ($file_category == "laporan_kemajuan") {
            $file_fetch = Laporan_kemajuan::where('laporan_kemajuan_id', $id)
                ->where('laporan_kemajuan_hash_name', $file_name)
                ->first();
            $file_url = URL::asset("assets/file/laporan_kemajuan/" . $file_fetch->laporan_kemajuan_hash_name);
            $file = public_path("assets/file/laporan_kemajuan/" . $file_fetch->laporan_kemajuan_hash_name);

            $file_extension = $file_fetch->laporan_kemajuan_extension;
             } else {
            return redirect()->route('coming_soon');
        }

        if ($file_fetch) {
            if ($file_extension == "pdf") {

                $headers = array(
                    'Content-Type' => mime_content_type($file),
                );

                return response()->file($file, $headers);
            } elseif ($file_extension == "jpg" || $file_extension == "jpeg" || $file_extension == "png" || $file_extension == "gif") {

                $headers = array(
                    'Content-Type' => mime_content_type($file),
                );

                return response()->file($file, $headers);
            } elseif ($file_extension == "doc" || $file_extension == "docx" || $file_extension == "xls" || $file_extension == "xlsx") {
                return redirect()->away('http://view.officeapps.live.com/op/view.aspx?src=' . $file_url);
            } else {
                return redirect()->route('coming_soon');
            }
        }
    }
    //End Preview
}
