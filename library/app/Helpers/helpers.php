<?php

	use App\Models\Member;
	use App\Models\Transaction;
	use Illuminate\Support\Carbon;
	
	function convert_date($value){
		return date('d M Y',strToTime($value));
	}

	function getNotif()
    {
        $currentDate = Carbon::now()->toDateString();
        $data = Member::select('members.id', 'members.name', Transaction::raw("DATEDIFF('$currentDate', transactions.date_end) AS hari"))
            ->join('transactions', 'transactions.member_id', '=', 'members.id')
            ->where('date_end', '<', $currentDate)
            ->where('status', 'Borrowed')
            ->get();

            return $data;
    }

    function convert_price($value)
	{
	    return 'Rp.' . number_format($value, 0, ',', '.');
	}
?>