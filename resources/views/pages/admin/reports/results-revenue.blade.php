@php
    $total = 0;
@endphp
<div>
    <h1 class="text-base font-bold">Year: {{ $year }}</h1>
</div>
<div class="table-responsive mt-4">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left  font-bold text-sm">Month</th>
                <th class="text-left  font-bold text-sm">Quantity</th>
                <th class="text-left  font-bold text-sm">Expenses</th>
                <th class="text-left  font-bold text-sm">Gross Income</th>
                <th class="text-left  font-bold text-sm">Net Income</th>
                <th class="text-left  font-bold text-sm">Net Profit</th>
                <th class="text-left  font-bold text-sm">Net Loss</th>
                <th class="text-left  font-bold text-sm">Net Profit + Net Loss</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataRevenues as $revenue)
                <tr>
                    <td>{{ $revenue['month'] }}</td>
                    <td>{{ $revenue['quantity'] }}</td>
                    <td>Rp.{{ number_format($revenue['expenses'], 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($revenue['gross_income'], 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($revenue['net_income'], 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($revenue['net_profit'], 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($revenue['net_loss'], 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($revenue['total'], 2, ',', '.') }}</td>
                    @php
                        $total += $revenue['total'];
                    @endphp
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No data available</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="7" class="text-right font-bold">Total</td>
                <td>Rp.{{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>
