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

    protected $travelEaseIssues = [
        '1' => 'Cara mendapatkan Travel Ease',
        '2' => 'Manfaat dari Travel Ease',
        '3' => 'Masa berlaku Travel Ease',
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

        $question = Question::create('Pertanyaan pertama: Apa yang ingin Anda lakukan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_first_question')
            ->addButtons([
                Button::create('Masalah pembelian tiket')->value('1'),
                Button::create('Masalah pesawat')->value('2'),
                Button::create('Masalah Travel Ease')->value('3'), // Pilihan baru
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
            } elseif ($response === '3') {
                $this->step = 5;
                $this->askTravelEase();
            } elseif ($response === 'kembali') {
                $this->goBack();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait masalah Travel Ease dengan animasi mengetik
    public function askTravelEase()
    {
        $this->step = 5; // Set step ke 5

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2);

        $question = Question::create('Masalah Travel Ease apa yang ingin Anda tanyakan?')
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_travel_ease')
            ->addButtons([
                Button::create('Cara mendapatkan Travel Ease')->value('1'),
                Button::create('Manfaat dari Travel Ease')->value('2'),
                Button::create('Masa berlaku Travel Ease')->value('3'),
                Button::create('Kembali')->value('kembali'),
            ]);

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            // Animasi mengetik sebelum memberikan jawaban
            $this->bot->typesAndWaits(1);

            if ($response === '1') {
                $this->say('Anda bisa mendapatkan Travel Ease dengan menghubungi customer support atau melalui aplikasi kami.');
            } elseif ($response === '2') {
                $this->say('Travel Ease memberikan perlindungan perjalanan dan fasilitas tambahan.');
            } elseif ($response === '3') {
                $this->say('Travel Ease berlaku selama satu tahun sejak pembelian.');
            } elseif ($response === 'kembali') {
                $this->goBack();
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }

    // Pertanyaan terkait masalah pembelian tiket dengan animasi mengetik
    public function askMyTicket()
    {
        $this->step = 2; // Set step ke 2

        // Animasi mengetik sebelum pertanyaan
        $this->bot->typesAndWaits(2);

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
                // Animasi mengetik sebelum jawaban
                $this->bot->typesAndWaits(1);
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

    // Fungsi untuk kembali ke pertanyaan sebelumnya berdasarkan step
    public function goBack()
    {
        switch ($this->step) {
            case 2:
            case 3:
            case 5:
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
