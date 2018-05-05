@extends("Base::layout")

@section('box-header-navbar')
    @include('Accounts::partials.searchbar', [
                'advancedSearchUrl' =>  '',
                'cancelSearchUrl'   =>  route('accounts.index'),
            ])
@endsection

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
                        <a href="{{route('account.details', $account->username)}}">
                            {{$account->username}}
                        </a>
                    </td>
                    <td>
                        {{$account->fname}} {{$account->lname}}
                    </td>
                    <td>
                        {!! Form::open(['route'=>['accounts.delete', $account->username], 'onsubmit'=>'confirm("Are you sure?")']) !!}
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('accounts.edit', $account->username)}}" class="btn btn-default btn-flat">
                                modify
                            </a>
                            <button class="btn btn-danger btn-flat">
                                remove
                            </button>
                        </div>
                        {!! Form::close() !!}
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
    {!! $accounts->links() !!}
@endsection