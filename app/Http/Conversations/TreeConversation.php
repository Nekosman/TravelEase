<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class TreeConversation extends Conversation
{
    protected $step = 1; // Step untuk melacak posisi percakapan user

    protected $ticketIssues = [
        '1' => 'Tiket sudah dibeli tapi belum mendapatkan kode konfirmasi.',
        '2' => 'Tiket yang dibeli tidak bisa digunakan untuk perjalanan.',
    ];

    protected $planeIssues = [
        '1' => 'Kode yang diberikan tidak dapat digunakan.',
        '2' => 'Kode yang dimasukkan salah meskipun sudah yakin.',
        '3' => 'Kode telah digunakan padahal saya belum melakukan perjalanan.',
    ];

    public function run()
    {
        $this->askFirstQuestion();
    }

    // Pertanyaan pertama dengan animasi mengetik
    public function askFirstQuestion()
    {
        $this->step = 1; // Set step ke 1

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2); 

<<<<<<< HEAD
        $question = Question::create('Selamat datang! Apa yang bisa saya bantu hari ini?')
            ->fallback('Tidak bisa memahami pilihan Anda. Mohon coba lagi.')
=======
        $question = Question::create('Pertanyaan pertama: Apa yang ingin Anda lakukan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
            ->callbackId('ask_first_question')
            ->addButtons([
                Button::create('Masalah Pembelian Tiket')->value('1'),
                Button::create('Masalah Pesawat')->value('2'),
                Button::create('Kembali ke Menu Utama')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === '1') {
                $this->step = 2;
                $this->askMyTicket();
            } elseif ($response === '2') {
                $this->step = 3;
                $this->askMyPlane();
            } elseif ($response === 'kembali') {
                $this->say('Anda telah kembali ke menu utama. Mari kita mulai lagi!');
                $this->askFirstQuestion();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait pembelian tiket dengan animasi mengetik
    public function askMyTicket()
    {
        $this->step = 2; // Set step ke 2

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2);

<<<<<<< HEAD
        $question = Question::create('Kami memahami bahwa Anda mungkin mengalami kesulitan dengan tiket. Masalah pembelian tiket apa yang ingin Anda tanyakan?')
            ->fallback('Tidak bisa memahami pilihan Anda. Mohon coba lagi.')
=======
        $question = Question::create('Masalah pembelian tiket apa yang ingin Anda tanyakan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
            ->callbackId('ask_my_ticket')
            ->addButtons([
                Button::create('Tiket sudah dibeli tapi belum mendapatkan kode konfirmasi.')->value('1'),
                Button::create('Tiket yang saya beli tidak bisa digunakan untuk perjalanan.')->value('2'),
                Button::create('Kembali ke Menu Utama')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === '1') {
                // Animasi mengetik sebelum jawaban
                $this->bot->typesAndWaits(1);
<<<<<<< HEAD
                $this->say('Silakan hubungi layanan pelanggan kami untuk mendapatkan kode tiket Anda.');
=======
                $this->say('Anda bisa menghubungi layanan pelanggan untuk mendapatkan kode tiket Anda.');
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
            } elseif ($response === '2') {
                $this->step = 4;
                $this->askPlaneIssueDetails();
            } elseif ($response === 'kembali') {
                $this->askFirstQuestion();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan lanjutan terkait masalah tiket tidak bisa dipakai dengan animasi mengetik
    public function askPlaneIssueDetails()
    {
        $this->step = 4; // Set step ke 4

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2);

<<<<<<< HEAD
        $question = Question::create('Untuk membantu kami menyelesaikan masalah Anda, dapatkah Anda menjelaskan masalah spesifik yang Anda alami?')
            ->fallback('Tidak bisa memahami pilihan Anda. Mohon coba lagi.')
=======
        $question = Question::create('Masalah spesifik apa yang Anda alami?')
            ->fallback('Tidak bisa memahami pilihan Anda')
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
            ->callbackId('ask_plane_issue_details')
            ->addButtons([
                Button::create('Kode tidak bisa digunakan.')->value('1'),
                Button::create('Kode yang dimasukkan salah padahal saya yakin benar.')->value('2'),
                Button::create('Kode saya sudah digunakan padahal saya belum melakukan perjalanan.')->value('3'),
                Button::create('Kembali ke Menu Utama')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            // Animasi mengetik sebelum memberikan jawaban
            $this->bot->typesAndWaits(1);

            if ($response === '1') {
                $this->say('Silakan hubungi layanan pelanggan kami untuk masalah kode yang tidak dapat digunakan.');
            } elseif ($response === '2') {
                $this->say('Kami sarankan Anda menghubungi tim teknis untuk memeriksa kesalahan pada kode Anda.');
            } elseif ($response === '3') {
                $this->say('Silakan hubungi dukungan pelanggan kami untuk melaporkan masalah ini dan mendapatkan bantuan.');
            } elseif ($response === 'kembali') {
                $this->askMyTicket();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait masalah pesawat dengan animasi mengetik
    public function askMyPlane()
    {
        $this->step = 3; // Set step ke 3

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2);

<<<<<<< HEAD
        $question = Question::create('Kami siap membantu Anda dengan masalah pesawat. Silakan pilih dari masalah berikut:')
            ->fallback('Tidak bisa memahami pilihan Anda. Mohon coba lagi.')
=======
        $question = Question::create('Pilihan masalah pesawat:')
            ->fallback('Tidak bisa memahami pilihan Anda')
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
            ->callbackId('ask_my_plane')
            ->addButtons([
                Button::create('Terlambat dalam penerbangan.')->value('1'),
                Button::create('Perubahan jadwal penerbangan.')->value('2'),
                Button::create('Kembali ke Menu Utama')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            // Animasi mengetik sebelum memberikan jawaban
            $this->bot->typesAndWaits(1);

            if ($response === '1') {
                $this->say('Kami mohon maaf atas keterlambatan ini. Silakan cek dengan layanan pelanggan untuk informasi lebih lanjut.');
            } elseif ($response === '2') {
                $this->say('Silakan hubungi layanan pelanggan untuk informasi tentang perubahan jadwal penerbangan.');
            } elseif ($response === 'kembali') {
                $this->askFirstQuestion();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Fungsi untuk kembali ke pertanyaan sebelumnya berdasarkan step
    public function goBack()
    {
        switch ($this->step) {
            case 2:
            case 3:
                $this->askFirstQuestion(); // Kembali ke pertanyaan pertama
                break;
            case 4:
                $this->askMyTicket(); // Kembali ke pertanyaan terkait tiket
                break;
            default:
                $this->say('Anda sudah berada di langkah pertama. Mari kita mulai lagi!');
                $this->askFirstQuestion();
        }
    }
}