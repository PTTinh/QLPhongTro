<p style="font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.5; margin-bottom: 20px;">
    Xin chào {{ $name }}
</p>
<p style="font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.5; margin-bottom: 20px;">
    Đây là trang ký hợp đồng của chúng tôi. Vui lòng nhấp vào liên kết dưới đây để ký hợp đồng.
</p>
<p>
    <a href="{{ route('mail-contract', ['id' => $id, 'uid' => $uid]) }}" style="font-family: Arial, sans-serif; font-size: 16px; color: #fff; background-color: #007bff; border-color: #007bff; display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; border: 1px solid transparent; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; border-radius: .25rem; text-decoration: none;">
        Ký hợp đồng
    </a>
</p>