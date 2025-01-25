<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Table: jurusan
        $this->forge->addField([
            'jurusan_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jurusan_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('jurusan_id');
        $this->forge->createTable('jurusan');

        // Table: akses
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'level' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('akses');

        // Table: kategori
        $this->forge->addField([
            'kategori_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kategori_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('kategori_id');
        // $this->forge->addForeignKey('kategori_id','akses','id','CASCADE','CASCADE');
        $this->forge->createTable('kategori');

        // Table: profil
        $this->forge->addField([
            'profil_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'profil_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'profil_isi' => [
                'type' => 'TEXT',
            ],
            'profil_tgl' => [
                'type' => 'DATE',
            ],
            'profil_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_akses' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addPrimaryKey('profil_id');
        // $this->forge->addForeignKey('id_akses', 'akses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profil');

        // Table: loker
        $this->forge->addField([
            'loker_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'loker_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'loker_isi' => [
                'type' => 'TEXT',
            ],
            'loker_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'loker_tgl' => [
                'type' => 'DATE',
            ],
            'loker_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'loker_nm_per' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_akses' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jurusan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addPrimaryKey('loker_id');
        // $this->forge->addForeignKey('id_akses', 'akses', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('jurusan_id', 'jurusan', 'jurusan_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loker');

        // Table: alumni
        $this->forge->addField([
            'alumni_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'alumni_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alumni_angkatan' => [
                'type'       => 'YEAR',
            ],
            'alumni_nohp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'alumni_alamat' => [
                'type' => 'TEXT',
            ],
            'alumni_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alumni_status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'alumni_aktif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alumni_regis' => [
                'type' => 'DATE',
            ],
            'alumni_jk' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'default'    => 'L',
            ],
            'alumni_nis' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alumni_tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alumni_tgl_lahir' => [
                'type' => 'DATE',
            ],
            'alumni_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('alumni_id');
        $this->forge->createTable('alumni');
        // Table: alumni (lanjutan)



    // Table: lowongan
    $this->forge->addField([
        'lowongan_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'alumni_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
        ],
        'loker_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
        ],
        'lowongan_tgl' => [
            'type' => 'DATE',
        ],
        'lowongan_file' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
    ]);
    $this->forge->addPrimaryKey('lowongan_id');
    // $this->forge->addForeignKey('alumni_id', 'alumni', 'alumni_id', 'CASCADE', 'CASCADE');
    // $this->forge->addForeignKey('loker_id', 'loker', 'loker_id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('lowongan');
}

public function down()
{
    $this->forge->dropTable('lowongan', true);
    $this->forge->dropTable('alumni', true);
    $this->forge->dropTable('loker', true);
    $this->forge->dropTable('profil', true);
    $this->forge->dropTable('kategori', true);
    $this->forge->dropTable('akses', true);
    $this->forge->dropTable('jurusan', true);
}
}
