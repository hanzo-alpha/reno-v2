<?php

namespace App\Filament\Reports;

use App\Models\BantuanRastra;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Components\VerticalSpace;
use EightyNine\Reports\Report;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Collection;

class BeritaAcara extends Report
{
    public ?string $heading = "Berita Acara";

    // public ?string $subHeading = "A great report";

    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Berita Acara Penyaluran Bantuan")
                                    ->title()
                                    ->primary(),
                            ])
                    ])
            ]);
    }


    public function body(Body $body): Body
    {
        return $body
            ->schema([
                Body\Layout\BodyColumn::make()
                    ->schema([
                        Body\Table::make()
                            ->data(
                                fn(?array $filters) => $this->registrationSummary($filters)
                            ),
                        VerticalSpace::make(),
//                    Body\Table::make()
//                        ->data(
//                            fn(?array $filters) => $this->verificationSummary($filters)
//                        ),
                    ])
            ]);
    }

    private function registrationSummary(?array $filters): Collection
    {
        return BantuanRastra::all();
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                Footer\Layout\FooterRow::make()
                    ->schema([
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make('Footer title')
                                    ->title()
                                    ->primary(),
                                Text::make('Footer subtitle')
                                    ->subtitle(),
                            ]),
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make('Generated on: '.now()->format('Y-m-d H:i:s')),
                            ])
                            ->alignRight(),
                    ]),
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('search')
                    ->placeholder('Search')
                    ->autofocus()
                    ->prefixIcon('heroicon-o-magnifying-glass'),
                Select::make('status')
                    ->placeholder('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ]);
    }

    private function verificationSummary(?array $filters): Collection
    {
        return BantuanRastra::all();

    }
}
