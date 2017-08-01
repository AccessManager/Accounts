@extends("Base::layout")

@section("content")
    <table class=" table table-hover table-responsive">
        <thead>
            <tr>
                <th>
                    sr no
                </th>
                <th>
                    username
                </th>
                <th>
                    account name
                </th>
                <th>
                    actions
                </th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $accounts->firstItem(); ?>
            @forelse( $accounts as $account )
                <tr>
                    <td>
                        {{$i++}}
                    </td>
                    <td>
                        {{$account->username}}
                    </td>
                    <td>
                        {{$account->name}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        no records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection