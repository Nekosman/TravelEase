<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class TreeConversation extends Conversation
{
    protected $step = 1; // Step untuk melacak posisi percakapan user

    protected $ticketIssues = [
        '1' => 'Tiket sudah dibeli tapi belum dapat kodenya',
        '2' => 'Tiket tidak bisa dipakai',
    ];

    protected $planeIssues = [
        '1' => 'Kode tidak bisa dipakai',
        '2' => 'Kode salah padahal sudah benar isinya',
        '3' => 'Kode keterangan sudah dipakai padahal belum dipakai',
    ];

    public function run()
    {
        $this->askFirstQuestion();
    }

    // Pertanyaan pertama dengan quick replies
    public function askFirstQuestion()
    {
        $this->step = 1; // Set step ke 1
        $question = Question::create('Pertanyaan pertama: Apa yang ingin Anda lakukan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_first_question')
            ->addButtons([
                Button::create('Masalah pembelian tiket')->value('1'),
                Button::create('Masalah pesawat')->value('2'),
                Button::create('Kembali')->value('kembali'),
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
                $this->goBack();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait pembelian tiket dengan quick replies
    public function askMyTicket()
    {
        $this->step = 2; // Set step ke 2
        $question = Question::create('Masalah pembelian tiket apa yang ingin Anda tanyakan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_my_ticket')
            ->addButtons([
                Button::create('Tiket sudah dibeli tapi belum dapat kodenya')->value('1'),
                Button::create('Tiket tidak bisa dipakai')->value('2'),
                Button::create('Kembali')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === '1') {
                $this->say('Anda bisa menghubungi layanan pelanggan untuk mendapatkan kode tiket Anda.');
            } elseif ($response === '2') {
                $this->step = 4;
                $this->askPlaneIssueDetails();
            } elseif ($response === 'kembali') {
                $this->goBack();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan lanjutan terkait masalah tiket tidak bisa dipakai
    public function askPlaneIssueDetails()
    {
        $this->step = 4; // Set step ke 4
        $question = Question::create('Masalah spesifik apa yang Anda alami?')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_plane_issue_details')
            ->addButtons([
                Button::create('Kode tidak bisa dipakai')->value('1'),
                Button::create('Kode salah padahal sudah benar')->value('2'),
                Button::create('Kode keterangan sudah dipakai padahal belum')->value('3'),
                Button::create('Kembali')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === '1') {
                $this->say('Anda bisa menghubungi layanan pelanggan untuk masalah kode yang tidak bisa dipakai.');
            } elseif ($response === '2') {
                $this->say('Silakan hubungi tim teknis untuk memeriksa kesalahan kode.');
            } elseif ($response === '3') {
                $this->say('Hubungi dukungan pelanggan untuk melaporkan masalah ini.');
            } elseif ($response === 'kembali') {
                $this->goBack();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait masalah pesawat dengan quick replies
    public function askMyPlane()
    {
        $this->step = 3; // Set step ke 3
        $question = Question::create('Pilihan masalah pesawat:')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_my_plane')
            ->addButtons([
                Button::create('Subpilihan B1')->value('1'),
                Button::create('Subpilihan B2')->value('2'),
                Button::create('Kembali')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === '1') {
                $this->say('Anda memilih subpilihan B1.');
            } elseif ($response === '2') {
                $this->say('Anda memilih subpilihan B2.');
            } elseif ($response === 'kembali') {
                $this->goBack();
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
                $this->say('Anda sudah berada di langkah pertama.');
                $this->askFirstQuestion();
        }
    }
}
