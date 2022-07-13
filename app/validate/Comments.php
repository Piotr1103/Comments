<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class Comments extends Validate
{
		/**
		 * 定义验证规则
		 * 格式：'字段名' =>	['规则1','规则2'...]
		 *
		 * @var array
		 */
		protected $rule = [
				'uid|用戶編號'				=>	'require|number|min:1|max:5',
				'content|評論內容'		=>	'require|min:5',
		];

		/**
		 * 定义错误信息
		 * 格式：'字段名.规则名' =>	'错误信息'
		 *
		 * @var array
		 */
		protected $message = [];
}
